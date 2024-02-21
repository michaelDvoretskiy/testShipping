<?php

namespace Mdvor\TestOneNofw\Controller;

use Mdvor\TestOneNofw\Model\DataModel;
use Mdvor\TestOneNofw\UI\UserInterface;

class MyController
{
    private $ui;
    private $model;
    private $validator;
    public function __construct()
    {
        $this->ui = new UserInterface();
        $this->model = new DataModel();

        $this->validator = new Validator();
    }

    function run()
    {
        switch ($_GET['action'] ?? '') {
            case 'upload':
                $this->ui->showCsvUpload();
                break;
            case 'uploadCsv':
                $this->model->uploadCsv();
            case 'price':
                $zones = $this->model->getZones();
                $this->ui->showPricePage($zones);
                break;
            default:
                $shipping = 0; $errors = [];
                if ($_POST) {
                    $errors = $this->validator->validateForm();
                    $shipping = $this->model->calcShipping($_POST['postcode'], $_POST['amount'], isset($_POST['long'], $errors));
                    $this->model->saveOrder($_POST['postcode'], $_POST['amount'], isset($_POST['long']), $shipping);
                }

                $this->ui->showHomePage($shipping, $errors);
        }
    }
}