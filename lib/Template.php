<?php class Template {

    //Chemin vers le Template
    protected $template;

    // Variables
    protected $vars = array();

    // Constructeur
    public function __construct($template) {
        $this->template = $template;
    }

    // Getter
    public function __get($key) {
        return $this->vars[$key];
    }

    // Setter
    public function __set($key, $value) {
        $this->vars[$key]=$value;
    }

    // Fonction to String
    public function __toString() {
        extract($this->vars);
        chdir(dirname($this->template));
        ob_start();

        include basename($this->template);

        return ob_get_clean();
    }

}