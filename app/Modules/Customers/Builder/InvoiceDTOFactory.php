<?php

namespace App\Modules\ElectronicInvoice\Builder;


use App\Modules\ElectronicInvoice\Builder\ConcreteBuilders\EgyptianCreditConcreteBuilder;
use App\Modules\ElectronicInvoice\Builder\ConcreteBuilders\CustomerConcreteBuilder;
use App\Modules\ElectronicInvoice\ConfigurationRetriever\InvoiceDataRetriever;
use App\Modules\ElectronicInvoice\ConfigurationRetriever\IssuerDataRetriever;
use App\Modules\ElectronicInvoice\ConfigurationRetriever\ReceiverDataRetriever;
use App\Repositories\InvoiceRepository;

class InvoiceDTOFactory
{

    public static function create($invoice_id,$type){
        $repo = resolve(InvoiceRepository::class);
        $invoice = $repo->getInvoiceByIdWithItems($invoice_id);
        $issuerDataRetriever = new IssuerDataRetriever();
        $receiverDataRetriever = new ReceiverDataRetriever($invoice);
        $InvoiceDataRetriever = new InvoiceDataRetriever($invoice);
        if($type=='invoice'){
            $builder = new CustomerConcreteBuilder($issuerDataRetriever,$receiverDataRetriever,$InvoiceDataRetriever);
            $invoiceCreator = new CustomerDTOCreation($builder);
        }elseif ($type == 'credit_note' || $type == 'refund_receipt'){
            $builder = new EgyptianCreditConcreteBuilder($issuerDataRetriever,$receiverDataRetriever,$InvoiceDataRetriever);
            $invoiceCreator = new CreditDTOCreator($builder);
        }

        return $invoiceCreator->getInvoice();
    }

}
