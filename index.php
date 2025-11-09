<?php

require __DIR__ . '/vendor/autoload.php';

use Mpdf\Mpdf;
use setasign\Fpdi\Tcpdf\Fpdi;


function blank_megahair(int $x0, $y0, array $order)
{

    $orderId = $order['id'];
    $orderCreatedAt = $order['orderCreatedAt'];
    $nameSeller = $order['nameSeller'];
    $addressSeller = $order['addressSeller'];
    $unpSeller = $order['unpSeller'];
    $unpSeller = $order['detailsBank'];
    $addressBank = $order['addressBank'];
    $bikBank = $order['bikBank'];
    $lastNameBuyer = $order['lastNameBuyer'];
    $firstNameBuyer = $order['firstNameBuyer'];
    $phoneBuyer = $order['phoneBuyer'];
    $cityBuyer = $order['cityBuyer'];
    $addressBuyer = $order['addressBuyer'];
    $itemName = $order['itemName'];
    $quantity = $order['quantity'];
    $price = $order['price'];

    $pdf = new Fpdi();
    $leftPageMargin = $topPageMargin = $rightPageMargin = $topPageMargin = 15;

    $pdf->SetAutoPageBreak(true, $topPageMargin);

    $widthA4 = 210;
    $baseX = $leftPageMargin + $x0;
    $baseY = $topPageMargin + $y0;
    $widthBlank = $widthA4 - 2 * $leftPageMargin;

    $mpdf = new Mpdf();

    $pageCount = $pdf->setSourceFile('blank1144.pdf');
    $templateId = $pdf->importPage(1);
    $pdf->AddPage();
    $pdf->useTemplate($templateId);

    $imageFile = __DIR__ . DIRECTORY_SEPARATOR . 'logoMegahair.jpg';

    $widthLogo = 137;
    $heightLogo = 30;
    $pdf->Image($imageFile, null, $baseY, $widthLogo, $heightLogo, '', '', 'C');
    //$pdf->Image($imageFile, $widthA4, $baseY, $widthLogo, $heightLogo);

    //$pdf->SetDrawColor(0, 0, 255);
    //$pdf->SetLineWidth(0.5);
    //$pdf->Rect($baseX, $baseY, $widthLogo, $heightLogo);

    $pdf->SetFont('notosansb', '', 12);
    //$pdf->SetTextColor(255, 0, 0);
    $pdf->SetXY($baseX + 51, $baseY + 35);
    $pdf->Write(0, "Заказ номер {$orderId}", '', false, 'C');

    $pdf->SetFont('notosansb', '', 10);
    $pdf->SetXY($baseX, $baseY + 54.5);
    $pdf->Write(0, 'Продавец');

    $pdf->Output(__DIR__ . DIRECTORY_SEPARATOR . 'output.pdf', 'F');

}

$order = include __DIR__ . DIRECTORY_SEPARATOR . 'orderData.php';

blank_megahair(0, 0, $order);

