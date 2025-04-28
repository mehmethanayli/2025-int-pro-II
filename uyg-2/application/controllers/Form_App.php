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
        $data = $this->Form_App_Model->get_all();

        $viewData = array(
            "items" => $data
        );

        /* Dönderilecek verilerin kontrol edilmesi */
        // print_r($viewData);

        /* Verilerin Gönderilmesi */
        $this->load->view("list_v", $viewData);
    }

    public function new_form()
    {
        $this->load->view("new_form_v");
    }
    public function insert()
    {

        /* Form Validation İşlemleri */
        /* Form Validasyon İşlemi: Formdan gelen verinin Controller seviyesinde bir kontrolünü gerçekleştirir. */

        /* 1.Form Validation Kütüphanesinin Yüklenmesi */
        $this->load->library("form_validation");

        /* 2. Kurallar Yazılır. */
        $this->form_validation->set_rules("name", "İsim", "required|trim");
        $this->form_validation->set_rules("surname", "Soyadı", "required|trim");
        $this->form_validation->set_rules("password", "Kullanıcı Şifresi", "required|trim|min_length[3]|max_length[12]");


        /* 3. Validasyon işlemi başarısız olursa kullanıcıya verilecek mesajlar tanımlanır. */
        $this->form_validation->set_message(
            array(
                "required" => "{field} alanının doldurulması zorunludur.",
                "min_length" => "{field} alanına minimum 3 karakter girilmesi gereklidir.",
                "max_length" => "{field} alanına maksimum 12 karakter girilebilir."
            )
        );


        /* 4. Validasyon çalıştırılırak bir sonuç bir değişkene atanır. */
        $validate = $this->form_validation->run();


        /* 5. Validasyonun durumuna göre aksiyon alınır. */

        if ($validate) {
            /* Form içeriği validasyondan başarıyla geçtiyse: */

            $data = array(
                "name" => $this->input->post("name"),
                "surname" => $this->input->post("surname"),
                "username" => $this->input->post("username"),
                "password" => md5($this->input->post("password"))
            );

            /* Form Verileri Validasyon Geçerse Kayıt İşlemi Yapılacak */
            $insert = $this->Form_App_Model->insert($data);
            if ($insert) {
                redirect("form_app");
            }
        } else {
            /* Form içeriği validasyondan geçemediyse: */
            /*echo "Formda Hata var"; */

            $view_data = new stdClass();
            $view_data->form_error = true;
            $this->load->view("new_form_v", $view_data);

        }

    }

    public function update_form($id)
    {
        $where = array(
            "id" => $id
        );

        $item = $this->Form_App_Model->get($where);
        //print_r($item);

        $view_data = new stdClass();
        $view_data->item = $item;

        $this->load->view("update_form_v", $view_data);

    }

    public function update($id)
    {
        $where = array(
            "id" => $id
        );

        $data = array(
            "name" => $this->input->post("name"),
            "surname" => $this->input->post("surname"),
            "username" => $this->input->post("username"),
            "password" => md5($this->input->post("password"))
        );

        $update = $this->Form_App_Model->update($where, $data);
        if ($update) {
            redirect("form_app");
        }

    }


    public function delete($id)
    {
        $where = array(
            "id" => $id
        );
        $delete = $this->Form_App_Model->delete($where);
        if ($delete) {
            redirect("form_app");
        }
    }

}
;
