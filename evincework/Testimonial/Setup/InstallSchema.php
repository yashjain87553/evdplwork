<?php
namespace Evdpl\Testimonial\Setup;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{
    public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        if (!$installer->tableExists('evdpl_testimonial')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('evdpl_testimonial')
            )
            ->addColumn(
                'testimonial_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [
                    'identity' => true,
                    'nullable' => false,
                    'primary'  => true,
                    'unsigned' => true,
                ],
                'Testimonial ID'
            )
            ->addColumn(
                'author_name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable => false'],
                'Author Name'
            )
            ->addColumn(
                'author_image',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'Author Image '
            )
            ->addColumn(
                'rating',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'Rating'
            )
            ->addColumn(
                'message',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'Message'
            )
            ->addColumn(
                'testimonial_date',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'Testimonial Date'
            )
           ->addColumn(
                'display_order',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [
                    'identity' => false,
                    'nullable' => true,
                    'primary'  => false,
                    'unsigned' => true,
                ],
                'Display Order'
            )
            ->addColumn(
                'status',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                '64k',
                [],
                'Status'
            )
             
            ->setComment('Product Label Table');
            $installer->getConnection()->createTable($table);
            $installer->endSetup();
            }
            }
            }