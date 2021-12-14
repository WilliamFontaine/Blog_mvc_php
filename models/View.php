<?php


class View
{
    private $_file;
    private $_t;

    public function __construct($action)
    {
        if ($action == "Admin")
            $this->_file = "views/admin/view" . $action . ".php";
        else
            $this->_file = "views/view" . $action . ".php";

    }


    /** Génère et affiche la vue
     * @param $data
     * @throws Exception
     */
    public function generate($data)
    {
        //Partie spécifique de la vue en question
        $content = $this->generateFile($this->_file, $data);
        $view = $this->generateFile('views/template.php', array('t' => $this->_t,
            'content' => $content));
        echo $view;
    }

    /** Génère un fichier vue et renvoie le résultat
     * @param $file
     * @param $data
     * @return false|string
     * @throws Exception
     */
    private function generateFile($file, $data)
    {
        if (file_exists($file)) {
            extract($data);
            ob_start();
            require $file;
            return ob_get_clean();
        } else {
            throw new Exception('Fichier ' . $file . ' introuvable.');
        }
    }

    public function generateEmpty($data)
    {
        //Partie spécifique de la vue en question
        $content = $this->generateFile($this->_file, $data);
        $view = $this->generateFile('views/templateEmpty.php', array('t' => $this->_t,
            'content' => $content));
        echo $view;
    }
}