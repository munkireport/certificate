<?php

/**
 * Certificate_controller class
 *
 * @package munkireport
 * @author AvB
 **/
class Certificate_controller extends Module_controller
{
    public function __construct()
    {
        $this->module_path = dirname(__FILE__);
    }

    /**
     * Default method
     *
     * @author AvB
     **/
    public function index()
    {
        echo "You've loaded the certificate report module!";
    }

    /**
     * Retrieve data in json format
     *
     * @return void
     * @author
     **/
    public function get_data($serial_number = '')
    {
        $obj = new View();

        if (! $this->authorized()) {
            $obj->view('json', array('msg' => 'Not authorized'));
            return;
        }

        $cert = new Certificate_model;
        $obj->view('json', array('msg' => $cert->retrieve_records($serial_number)));
    }

    /**
     * Get stats for button widget
     *
     **/
    public function get_stats()
    {
        $now = time();
        $one_month = $now + 3600 * 24 * 30 * 1;
        $sql = "SELECT COUNT(1) as total,
                        COUNT(CASE WHEN `cert_exp_time` < '$now' THEN 1 END) AS 'expired', 
                        COUNT(CASE WHEN `cert_exp_time` BETWEEN '$now' AND '$one_month' THEN 1 END) AS 'soon',
                        COUNT(CASE WHEN `cert_exp_time` > '$one_month' THEN 1 END) AS 'ok'
                        from certificate
                        LEFT JOIN reportdata USING (serial_number)
                        WHERE ".get_machine_group_filter('');

        $out = [];
        $queryobj = new Certificate_model();
        foreach($queryobj->query($sql)[0] as $label => $value){
                $out[] = ['label' => $label, 'count' => $value];
        }

        jsonView($out);
    }


    /**
     * Get stats for scroll widget
     *
     **/
    public function get_certificates()
     {

        $sql = "SELECT cert_cn, COUNT(1) AS count
                FROM certificate
                LEFT JOIN reportdata USING (serial_number)
                ".get_machine_group_filter()."
                GROUP BY cert_cn
                ORDER BY COUNT DESC";

        $queryobj = new Macos_security_compliance_model;
        jsonView($queryobj->query($sql));
     }

} // END class Certificate_controller
