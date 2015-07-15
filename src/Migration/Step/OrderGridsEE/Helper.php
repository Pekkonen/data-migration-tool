<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Migration\Step\OrderGridsEE;

/**
 * Class Helper
 */
class Helper extends \Migration\Step\OrderGrids\Helper
{
    /**
     * @inheritdoc
     */
    public function getSelectData()
    {
        $selectedData = parent::getSelectData();
        $documentListArchive = [
            'getSelectSalesOrderGridArchive' =>
                $this->getDocumentData('magento_sales_order_grid_archive'),
            'getSelectSalesInvoiceGridArchive' =>
                $this->getDocumentData('magento_sales_invoice_grid_archive'),
            'getSelectSalesShipmentGridArchive' =>
                $this->getDocumentData('magento_sales_shipment_grid_archive'),
            'getSelectSalesCreditmemoGridArchive' =>
                $this->getDocumentData('magento_sales_creditmemo_grid_archive')
        ];

        return array_merge($selectedData, $documentListArchive);
    }

    /**
     * @inheritdoc
     */
    protected function getColumnsData($gridName)
    {
        $columnsData = parent::getColumnsData($gridName);
        if (!$columnsData) {
            switch ($gridName){
                case 'magento_sales_order_grid_archive':
                    $columnsData = $this->getSalesOrderColumnsGrid();
                    break;
                case 'magento_sales_invoice_grid_archive':
                    $columnsData = $this->getSalesInvoiceColumnsGrid();
                    break;
                case 'magento_sales_shipment_grid_archive':
                    $columnsData = $this->getSalesShipmentColumnsGrid();
                    break;
                case 'magento_sales_creditmemo_grid_archive':
                    $columnsData = $this->getSalesCreditMemoColumnsGrid();
                    break;
                default: null;
            }
        }
        return $columnsData;
    }

    /**
     * @inheritdoc
     */
    protected function getSalesOrderColumnsGrid()
    {
        $columnsGrid = parent::getSalesOrderColumnsGrid();
        $columnsGrid['refunded_to_store_credit'] = 'sales_order.customer_bal_total_refunded';
        return $columnsGrid;
    }

    /**
     * @inheritdoc
     */
    public function getDocumentList()
    {
        $documentList = parent::getDocumentList();
        $documentListArchive = [
            'enterprise_sales_order_grid_archive' => 'magento_sales_order_grid_archive',
            'enterprise_sales_invoice_grid_archive' => 'magento_sales_invoice_grid_archive',
            'enterprise_sales_shipment_grid_archive' => 'magento_sales_shipment_grid_archive',
            'enterprise_sales_creditmemo_grid_archive' => 'magento_sales_creditmemo_grid_archive'
        ];
        return array_merge($documentList, $documentListArchive);
    }
}
