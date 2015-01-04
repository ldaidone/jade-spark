## Jade-Spark

This is a small spark that let you use Jade-lang template engine in Codeigniter 2.

### Requirements:

You will need to have Jade binary installed in your system.

To install via npm:

``` $ npm install jade ```

### Jade-Spark Installation:


You should generally use the [spark system](http://getsparks.org/get-sparks)
to install jade-spark. From the terminal, and inside the root of a CodeIgniter
project, type:

`php tools/spark install jade-spark`

### Usage:


### Examples:

Controller
```php
    class Welcome extends CI_Controller {
    
        public function index()
        {
            $this->load->spark('jade-spark/0.0.1');
            $other = $this->input->get_post('other_name', TRUE);
            $params = [
                "first_name"=>"Leo",
                "other_name"=>$other,
            ];
            $this->jade_spark->render("welcome",$params);
        }
    }
```    

Jade template
```php 
    doctype html
    html
       head
          title "testing Jade Spark"
       body
          div#content
             = "This is my first jade view with CodeIgniter!!!"
          hr
          div
             if first_name
                strong
                   p Hello #{first_name}
             else
                strong
                   p Hello User!
          hr
          div
             if other_name
                strong
                   p Hello #{other_name}
```
