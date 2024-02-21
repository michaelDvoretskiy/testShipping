<?php

namespace Mdvor\TestOneNofw\UI;

class UserInterface
{
    function showHomePage($shipping, $errors)
    {
        include_once 'Template\orderFormTemplate.php';
    }

    function showCsvUpload()
    {
        include_once 'Template\uploadCsvFormTemplate.php';
    }

    function showPricePage($zones)
    {
        include_once 'Template\priceTemplate.php';
    }
}