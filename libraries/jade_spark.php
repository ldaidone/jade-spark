<?php
/**
 * Created by PhpStorm.
 * User: leodaido
 * Date: 12/15/14
 * Time: 1:12 PM
 */

class Jade_spark {

    public function render($jadefile, $params=[])
    {
        $fullpath = $this->getTemplateFullPath($this->sanitizeFilename($jadefile));

        $command = $this->getCommand($fullpath, $this->encodeParams($params));
        $this->printOutput($command, $params, $fullpath);
    }

    // Private scope
    private function getCommand($fullpath, $params_json){
        $jade_tpl_path = config_item('jade_tpl_path');
        return "{$this->getJadeBin()} < {$fullpath} --path {$jade_tpl_path}d --obj {$params_json}";
    }

    private function getJadeBin(){
        return escapeshellarg(config_item('jade_bin'));
    }

    private function getTemplateFullPath($jade_file){
        $jade_tpl_path = config_item('jade_tpl_path');
        return escapeshellarg("{$jade_tpl_path}{$jade_file}.jade");
    }

    private function sanitizeFilename($jade_file){
        // work for people who use ".jade" extension
        return preg_replace("/(.jade)$/", "", $jade_file);
    }

    private function encodeParams($params, $options=0){
        $params_json = json_encode($params,$options);
        if(json_last_error() > JSON_ERROR_NONE){
            die("There was an error while try to encode params.");
        }else{
            return escapeshellarg($params_json);
        }
    }

    private function printOutput($command, $params, $fullpath){
        $status = 0;
        $output = array();
        exec($command, $output, $status);
        if($status==0){
            echo join(' ',$output);
        }else{
            $params = $this->encodeParams($params,JSON_PRETTY_PRINT);
            if(join(' ',$output)){
                echo "<pre><h5>command:<br/>{$command}</h5><h5>params:{$params}<br/></h5><h5>Issue:{join(' ',$output)}</h5></pre>";
            }else{
                echo "<pre><h5>command:<br/>{$command}</h5><h5>params:{$params}<br/></h5><h5>Issue:<br>probably file not found(please check if file {$fullpath} exists)</h5></pre>";
            }
        }
    }
}