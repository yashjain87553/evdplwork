<?php
namespace Evdpl\Productlabel\Setup;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{
    public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        if (!$installer->tableExists('product_label_table')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('product_label_table')
            )
            ->addColumn(
                'label_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [
                    'identity' => true,
                    'nullable' => false,
                    'primary'  => true,
                    'unsigned' => true,
                ],
                'Label ID'
            )
            ->addColumn(
                'label_name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable => false'],
                'Label Name'
            )
            ->addColumn(
                'product_label_logo',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'Product label logo'
            )
            ->addColumn(
                'category_label_logo',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'Category label logo'
            )
            ->addColumn(
                'products',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'Products ID'
            )
            ->addColumn(
                'status',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                '64k',
                [],
                'Label Status'
            )
             ->addColumn(
                'category_label_color',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable => false'],
                'Label Color'
            )
             ->addColumn(
                'category_label_text',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable => false'],
                'Label Text'
            )
             ->addColumn(
                'product_label_color',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable => false'],
                'Label Color'
            )
             ->addColumn(
                'product_label_text',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable => false'],
                'Label Text'
            )
             ->addColumn(
                'category_label_position',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable => false'],
                'Category Label Position'
            )
              ->addColumn(
                'product_label_position',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable => false'],
                'Product Label Position'
            )
            ->setComment('Product Label Table');
            $installer->getConnection()->createTable($table);
            $installer->endSetup();
            }
            }
            }