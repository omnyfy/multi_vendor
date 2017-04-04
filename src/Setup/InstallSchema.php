<?php
/**
 * Project: Omnyfy Multi Vendor.
 * User: jing
 * Date: 4/4/17
 * Time: 10:55 AM
 */
namespace Omnyfy\Vendor\Setup;

use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;


class InstallSchema implements InstallSchemaInterface
{

    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {

        $installer = $setup;
        $installer->startSetup();
        if (!$installer->tableExists('omnyfy_vendor')) {
            $vendorTable = $installer->getConnection()->newTable(
                $installer->getTable('omnyfy_vendor')
            )
                ->addColumn(
                    'vendor_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true],
                    'Entity ID'
                )
                ->addColumn(
                    'name',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'Business Name'
                )
                ->addColumn(
                    'status',
                    Table::TYPE_SMALLINT,
                    null,
                    ['nullable' => false, 'default' => '0'],
                    'Status'
                )
                ->addColumn(
                    'address',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'Business Address'
                )
                ->addColumn(
                    'phone',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'Business Contact Number'
                )
                ->addColumn(
                    'email',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'Business Email Address'
                )
                ->addColumn(
                    'fax',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => true],
                    'Business Fax Number'
                )
                ->addColumn(
                    'social_media',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => true],
                    'Business Social Media'
                )
                ->addColumn(
                    'description',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => true],
                    'Business Description'
                )
                ->addColumn(
                    'abn',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'ABN'
                )
                ->addColumn(
                    'logo',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => true],
                    'Business Logo'
                )
                ->addColumn(
                    'banner',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => true],
                    'Business Background Banner'
                )
            ;
            $installer->getConnection()->createTable($vendorTable);
        }

        if (!$installer->tableExists('omnyfy_location')) {
            $locationTable = $installer->getConnection()->newTable(
                $installer->getTable('omnyfy_location')
            )
                ->addColumn(
                    'location_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true],
                    'Entity ID'
                )
                ->addColumn(
                    'vendor_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['nullable' => false],
                    'Vendor ID'
                )
                ->addColumn(
                    'priority',
                    Table::TYPE_INTEGER,
                    null,
                    ['nullable' => false, 'default' => 9999],
                    'Priority'
                )
                ->addColumn(
                    'name',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'Location Name'
                )
                ->addColumn(
                    'description',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => true],
                    'Location Description'
                )
                ->addColumn(
                    'address',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'Location Address'
                )
                ->addColumn(
                    'suburb',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'Suburb'
                )
                ->addColumn(
                    'region',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'Region'
                )
                ->addColumn(
                    'country',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'Country'
                )
                ->addColumn(
                    'postcode',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'postcode'
                )
                ->addColumn(
                    'latitude',
                    Table::TYPE_DECIMAL,
                    '10,6',
                    ['nullable' => false],
                    'ABN'
                )
                ->addColumn(
                    'longitude',
                    Table::TYPE_DECIMAL,
                    '10,6',
                    ['nullable' => false],
                    'Business Logo'
                )
                ->addForeignKey(
                    $installer->getFkName('omnyfy_location', 'vendor_id', 'omnyfy_vendor', 'vendor_id'),
                    'vendor_id',
                    $installer->getTable('omnyfy_vendor'),
                    'vendor_id',
                    Table::ACTION_NO_ACTION
                )
            ;
            $installer->getConnection()->createTable($locationTable);
        }

        $quoteItemTable = $installer->getTable('quote_item');
        $installer->getConnection()
            ->addColumn(
                $quoteItemTable,
                'location_id',
                [
                    'type' => Table::TYPE_INTEGER,
                    'nullable' => false,
                    'comment' => 'Location ID'
                ]
            )
            ->addForeignKey(
                $installer->getFkName('quote_item', 'location_id', 'omnyfy_location', 'location_id'),
                $quoteItemTable,
                'location_id',
                $installer->getTable('omnyfy_location'),
                'location_id',
                Table::ACTION_NO_ACTION
            )
        ;
        $quoteShippingRateTable = $installer->getTable('quote_shipping_rate');
        $installer->getConnection()
            ->addColumn(
                $quoteShippingRateTable,
                'location_id',
                [
                    'type' => Table::TYPE_INTEGER,
                    'nullable' => false,
                    'comment' => 'Location ID'
                ]
            )
            ->addForeignKey(
                $installer->getFkName('quote_shipping_rate', 'location_id', 'omnyfy_location', 'location_id'),
                $quoteShippingRateTable,
                'location_id',
                $installer->getTable('omnyfy_location'),
                'location_id',
                Table::ACTION_NO_ACTION
            )
        ;

        $shipmentTable = $installer->getTable('sales_shipment');
        $installer->getConnection()
            ->addColumn(
                $shipmentTable,
                'location_id',
                [
                    'type' => Table::TYPE_INTEGER,
                    'nullable' => false,
                    'comment' => 'Location ID'
                ]
            )
            ->addForeignKey(
                $installer->getFkName('sales_shipment', 'location_id', 'omnyfy_location', 'location_id'),
                $shipmentTable,
                'location_id',
                $installer->getTable('omnyfy_location'),
                'location_id',
                Table::ACTION_NO_ACTION
            )
        ;

        //invoice-vendor relation table
        if (!$installer->tableExists('omnyfy_invoice_vendor')) {
            $invoiceVendorTable = $installer->getConnection()->newTable(
                $installer->getTable('omnyfy_invoice_vendor')
            )
                ->addColumn(
                    'invoice_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['nullable' => false],
                    'Invoice ID'
                )
                ->addColumn(
                    'vendor_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['nullable' => false],
                    'Vendor ID'
                )
                ->addIndex(
                    $installer->getIdxName(
                        'omnyfy_invoice_vendor',
                        ['invoice_id', 'vendor_id'],
                        AdapterInterface::INDEX_TYPE_UNIQUE
                    ),
                    ['invoice_id', 'vendor_id'],
                    ['type' => AdapterInterface::INDEX_TYPE_UNIQUE]
                )
                ->addForeignKey(
                    $installer->getFkName('omnyfy_invoice_vendor', 'vendor_id', 'omnyfy_vendor', 'vendor_id'),
                    'vendor_id',
                    $installer->getTable('omnyfy_vendor'),
                    'vendor_id',
                    Table::ACTION_CASCADE
                )
                ->addForeignKey(
                    $installer->getFkName('omnyfy_invoice_vendor', 'invoice_id', 'sales_invoice', 'entity_id'),
                    'invoice_id',
                    $installer->getTable('sales_invoice'),
                    'entity_id',
                    Table::ACTION_CASCADE
                )
            ;
            $installer->getConnection()->createTable($invoiceVendorTable);
        }

        //order-vendor relation table
        if (!$installer->tableExists('omnyfy_order_vendor')) {
            $orderVendorTable = $installer->getConnection()->newTable(
                $installer->getTable('omnyfy_order_vendor')
            )
                ->addColumn(
                    'order_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['nullable' => false],
                    'Order ID'
                )
                ->addColumn(
                    'vendor_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['nullable' => false],
                    'Vendor ID'
                )
                ->addIndex(
                    $installer->getIdxName(
                        'omnyfy_order_vendor',
                        ['order_id', 'vendor_id'],
                        AdapterInterface::INDEX_TYPE_UNIQUE
                    ),
                    ['order_id', 'vendor_id'],
                    ['type' => AdapterInterface::INDEX_TYPE_UNIQUE]
                )
                ->addForeignKey(
                    $installer->getFkName('omnyfy_order_vendor','order_id', 'sales_order', 'entity_id'),
                    'order_id',
                    $installer->getTable('sales_order'),
                    'entity_id',
                    Table::ACTION_CASCADE
                )
                ->addForeignKey(
                    $installer->getFkName('omnyfy_order_vendor', 'vendor_id', 'omnyfy_vendor', 'vendor_id'),
                    'vendor_id',
                    $installer->getTable('omnyfy_vendor'),
                    'vendor_id',
                    Table::ACTION_CASCADE
                )
            ;
            $installer->getConnection()->createTable($orderVendorTable);
        }

        //admin_user-vendor relation table
        if (!$installer->tableExists('omnyfy_admin_user_vendor')) {
            $adminUserVendorTable = $installer->getConnection()->newTable(
                $installer->getTable('omnyfy_admin_user_vendor')
            )
                ->addColumn(
                    'user_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['nullable' => false],
                    'Admin User ID'
                )
                ->addColumn(
                    'vendor_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['nullable' => false],
                    'Vendor ID'
                )
                ->addIndex(
                    $installer->getIdxName(
                        'omnyfy_admin_user_vendor',
                        ['user_id', 'vendor_id'],
                        ['type' => AdapterInterface::INDEX_TYPE_UNIQUE]
                    ),
                    ['user_id', 'vendor_id'],
                    ['type' => AdapterInterface::INDEX_TYPE_UNIQUE]
                )
                ->addForeignKey(
                    $installer->getFkName('omnyfy_admin_user_vendor', 'user_id', 'admin_user', 'user_id'),
                    'user_id',
                    $installer->getTable('admin_user'),
                    'user_id',
                    Table::ACTION_CASCADE
                )
                ->addForeignKey(
                    $installer->getFkName('omnyfy_admin_user_vendor', 'vendor_id', 'omnyfy_vendor', 'vendor_id'),
                    'vendor_id',
                    $installer->getTable('omnyfy_vendor'),
                    'vendor_id',
                    Table::ACTION_CASCADE
                )
                ;
            $installer->getConnection()->createTable($adminUserVendorTable);
        }

        //store_website-vendor relation table
        if (!$installer->tableExists('omnyfy_store_website_vendor')) {
            $storeWebsiteVendorTable = $installer->getConnection()->newTable(
                $installer->getTable('omnyfy_store_website_vendor')
            )
                ->addColumn(
                    'website_id',
                    Table::TYPE_SMALLINT,
                    null,
                    ['nullable' => false],
                    'Website ID'
                )
                ->addColumn(
                    'vendor_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['nullable' => false],
                    'Vendor ID'
                )
                ->addIndex(
                    $installer->getIdxName(
                        'omnyfy_store_website_vendor',
                        ['website_id', 'vendor_id'],
                        ['type' => AdapterInterface::INDEX_TYPE_UNIQUE]
                    ),
                    ['website_id', 'vendor_id'],
                    ['type' => AdapterInterface::INDEX_TYPE_UNIQUE]
                )
                ->addForeignKey(
                    $installer->getFkName('omnyfy_store_website_vendor', 'website_id', 'store_website', 'website_id'),
                    'website_id',
                    $installer->getTable('store_website'),
                    'website_id',
                    Table::ACTION_CASCADE
                )
                ->addForeignKey(
                    $installer->getFkName('omnyfy_store_website_vendor', 'vendor_id', 'omnyfy_vendor', 'vendor_id'),
                    'vendor_id',
                    $installer->getTable('omnyfy_vendor'),
                    'vendor_id',
                    Table::ACTION_CASCADE
                )
            ;
            $installer->getConnection()->createTable($storeWebsiteVendorTable);
        }

        //product-vendor relation table
        if (!$installer->tableExists('omnyfy_product_vendor')) {
            $productVendorTable = $installer->getConnection()->newTable(
                $installer->getTable('omnyfy_product_vendor')
            )
                ->addColumn(
                    'product_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['nullable' => false],
                    'Product ID'
                )
                ->addColumn(
                    'vendor_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['nullable' => false],
                    'Vendor ID'
                )
                ->addIndex(
                    $installer->getIdxName(
                        'omnyfy_product_vendor',
                        ['product_id', 'vendor_id'],
                        ['type' => AdapterInterface::INDEX_TYPE_UNIQUE]
                    ),
                    ['product_id', 'vendor_id'],
                    ['type' => AdapterInterface::INDEX_TYPE_UNIQUE]
                )
                ->addForeignKey(
                    $installer->getFkName('omnyfy_product_vendor', 'product_id', 'catalog_product_entity', 'entity_id'),
                    'product_id',
                    $installer->getTable('catalog_product_entity'),
                    'entity_id',
                    Table::ACTION_CASCADE
                )
                ->addForeignKey(
                    $installer->getFkName('omnyfy_product_vendor', 'vendor_id', 'omnyfy_vendor', 'vendor_id'),
                    'vendor_id',
                    $installer->getTable('omnyfy_vendor'),
                    'vendor_id',
                    Table::ACTION_CASCADE
                )
            ;
            $installer->getConnection()->createTable($productVendorTable);
        }

        //omnyfy inventory
        if (!$installer->tableExists('omnyfy_inventory')) {
            $omnyfyInventoryTable = $installer->getConnection()->newTable(
                $installer->getTable('omnyfy_inventory')
            )
                ->addColumn(
                    'product_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['nullable' => false],
                    'Product ID'
                )
                ->addColumn(
                    'location_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['nullable' => false],
                    'Location ID'
                )
                ->addColumn(
                    'qty',
                    Table::TYPE_DECIMAL,
                    '12,4',
                    ['nullable' => false,'default' => '0.0'],
                    'Quantity'
                )
                ->addIndex(
                    $installer->getIdxName(
                        'omnyfy_inventory',
                        ['product_id', 'location_id'],
                        ['type' => AdapterInterface::INDEX_TYPE_UNIQUE]
                    ),
                    ['product_id', 'location_id'],
                    ['type' => AdapterInterface::INDEX_TYPE_UNIQUE]
                )
                ->addForeignKey(
                    $installer->getFkName('omnyfy_inventory', 'product_id', 'catalog_product_entity', 'entity_id'),
                    'product_id',
                    $installer->getTable('catalog_product_entity'),
                    'entity_id',
                    Table::ACTION_CASCADE
                )
                ->addForeignKey(
                    $installer->getFkName('omnyfy_inventory', 'location_id', 'omnyfy_location', 'location_id'),
                    'location_id',
                    $installer->getTable('omnyfy_location'),
                    'location_id',
                    Table::ACTION_CASCADE
                )
            ;
            $installer->getConnection()->createTable($omnyfyInventoryTable);
        }

        //omnyfy form

        //omnyfy form field

        //omnyfy form data

        $installer->endSetup();
    }
}






