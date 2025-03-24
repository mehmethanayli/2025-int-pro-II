<?php
class Form_App extends CI_Controller
{

    /* Sınıfın yapıcı metodu.. Sınıf çağırıldığında otomatik çalışır. */
    public function __construct()
    {
        parent::__construct();
    }

    /* Kayıt formunun ekrana basılmasını sağlayan fonksiyon. */
    public function index()
    {
        $this->load->view("form_v");
    }
    public function insert()
    {
        echo "Formdan gelen veriler: <br>";
        $name = $this->input->post("name");
        $surname = $this->input->post("surname");
        $username = $this->input->post("username");
        $password = $this->input->post("password");

        echo "Adı : $name <br>";
        echo "Soyadı: $surname <br>";
        echo "Kullanıcı Adı: $username <br>";
        echo "Şifre: $password <br>";

        $data = array(
            "name" => $this->input->post("name"), /* Formdan gelen veri kullanılabilir. */
            "surname" => $surname, /* Değişken kullanılabilir. */
            "username" => $username,
            "password" => md5($password)
        );
        // print_r($data);
        $this->load->model("Form_App_Model");
        $insert = $this->Form_App_Model->insert($data);

        if ($insert) {
            redirect("form_app/list");
        } else {
            redirect("form_app");
        }
    }

    public function list()
    {
        //echo "Bu Fonksiyon çalıştı mı_?";

        $this->load->model("Form_App_Model");
        $data = $this->Form_App_Model->get_all();

        /* Gelen verilerin kontrol edilmesi */
        //echo "<pre>";
        //print_r($data);
        //echo "</pre>";

        $viewData = array(
            "items" => $data
        );

        /* Dönderilecek verilerin kontrol edilmesi */
        // print_r($viewData);

        /* Verilerin Gönderilmesi */
        $this->load->view("list_v", $viewData);
    }
};
