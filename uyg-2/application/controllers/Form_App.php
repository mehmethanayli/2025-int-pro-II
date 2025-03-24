<?php
class Form_App extends CI_Controller
{

    /* Sınıfın yapıcı metodu.. Sınıf çağırıldığında otomatik çalışır. */
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Form_App_Model");
    }

    /* Kayıt formunun ekrana basılmasını sağlayan fonksiyon. */
    public function index()
    {
        $this->load->view("form_v");
    }
    public function insert()
    {

        /* Form Validation İşlemleri */

        /* Form Validation Kütüphanesinin Yüklenmesi */
        $this->load->library("form_validation");

        /* Form Validation Kuralları */
        $this->form_validation->set_rules("name", "İsim", "required|trim");
        $this->form_validation->set_rules("surname", "Soyadı", "required|trim");
        $this->form_validation->set_rules("password", "Kullanıcı Şifresi", "required|trim|min_length[3]|max_length[12]");


        /* Hata Mesajları */
        $this->form_validation->set_message(
            array(
                "required" => "{field} alanının doldurulması zorunludur.",
                "min_length" => "{field} alanına minimum 3 karakter girilmesi gereklidir.",
                "max_length" => "{field} alanına maksimum 12 karakter girilebilir."
            )
        );


        $validate = $this->form_validation->run();
        if ($validate) {
            $data = array(
                "name" => $this->input->post("name"),
                "surname" => $this->input->post("surname"),
                "username" => $this->input->post("username"),
                "password" => md5($this->input->post("password"))
            );

            /* Form Verileri Validasyon Geçerse Kayıt İşlemi Yapılacak */
            $insert = $this->Form_App_Model->insert($data);
            if ($insert) {
                redirect("form_app/list");
            } else {
                redirect("form_app");
            }
        } else {
            /* Validasyon Geçilmediğinde Hatanın Gösterilmesi */
            $view_data = new stdClass();
            $view_data->form_error = true;
            $this->load->view("form_v", $view_data);

        }

    }

    public function list()
    {
        $data = $this->Form_App_Model->get_all();

        $viewData = array(
            "items" => $data
        );

        /* Dönderilecek verilerin kontrol edilmesi */
        // print_r($viewData);

        /* Verilerin Gönderilmesi */
        $this->load->view("list_v", $viewData);
    }
}
;
