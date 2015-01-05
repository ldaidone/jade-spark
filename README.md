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

Once you have installed the spark, you just have to load 'jade-spark' in your controller by adding:
 `$this->load->spark('jade-spark/0.0.1');`

*a good practice to load sparks would be override controller's constructor, eg:*
```php
    public function __construct(){
   		parent::__construct();
   		$this->load->spark('jade-spark/0.0.1');
    }
```

Create a view template, with `.jade` extension, defaulted in `views` directory of your Codeigniter app. *(This directory can be changed in spark's configuration.)*

*For Jade-lang references [click here](http://jade-lang.com/reference/)*

Finally, invoke `render` method in your controller, passing template name as first argument and optional array of params as second argument.

```php
...
$this->jade_spark->render("welcome",$params);
...
```

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
