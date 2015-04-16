<?php
/**
 * Created by PhpStorm.
 * User: leodaido
 * Date: 4/16/15
 * Time: 5:24 PM
 */

class CLIStatus {
    const SUCCESS           = 0;
    const MISC              = 1;
    const MISUSE            = 2;
    const CANNOT_EXECUTE    = 126;
    const NOT_FOUND         = 127;
    const FATAL             = 128;

    /**
     * Parse shell script exit code and return human readable error message.
     *
     * @param $status
     * @return StdClass
     */
    public static function parseCliStatus($status){
        $result = new StdClass();
        $result->success = false;
        switch($status){
            case CLIStatus::SUCCESS:
                $result->errorMsg = "Success";
                $result->success = true;
                break;
            case CLIStatus::MISC:
                $result->errorMsg = "General error (1)";
                break;
            case CLIStatus::MISUSE:
                $result->errorMsg = "Misuse of shell builtins";
                break;
            case CLIStatus::CANNOT_EXECUTE:
                $result->errorMsg = "Command invoked cannot execute";
                break;
            case CLIStatus::NOT_FOUND:
                $result->errorMsg= "command not found";
                break;
            case CLIStatus::FATAL:
            default:
                $result->errorMsg = "Fatal error ({$status})";
        }
        return $result;
    }

    /**
     * Pretty print of error message box based on params.
     *
     * @param $message
     * @param $command
     * @param $params
     * @param null $extra
     */
    public static function prettyPrintError($message, $command, $params, $extra=null){
        echo "<div style=\"width: 95%; border: solid 2px red; background-color: antiquewhite; margin: 0 auto 0 auto; padding: 20px;\">";
        echo "<h4>Error message:</h4><h4 style='margin-left: 35px; font-family: \"courier\"; font-size: small;'>{$message}</h4>";
        echo "<h4>Command:</h4><h4 style='margin-left: 35px; font-family: \"courier\"; font-size: small;'>{$command}</h4>";
        echo "<h4>Params:</h4><h4 style='margin-left: 35px; font-family: \"courier\"; font-size: small;'>{$params}</h4>";
        if(isset($extra)) {
            echo "<h4>Output:</h4><h4 style='margin-left: 35px; font-family: \"courier\"; font-size: small;'>{$extra}</h4>";
        }
        echo "</div>";
    }
}