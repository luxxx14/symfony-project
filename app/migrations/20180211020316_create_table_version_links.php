<?php


use Phinx\Migration\AbstractMigration;

class CreateTableVersionLinks extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $version_links = $this->table('version_links');

        $version_links->addColumn('link_type', 'string', array('limit' => 128))
            ->addColumn('link_url', 'string', array('limit' => 256))
            ->create();

        $rows = [
            [
                'link_type'    => 'Полная история версий',
                'link_url'  => 'https://artifactory.corchestra.ru/artifactory/list/corchestra-dev/'
            ],
            [
                'link_type'    => 'Репозиторий на Github',
                'link_url'  => 'https://github.com/CourseOrchestra/corchestra'
            ]
        ];

        $version_links->insert($rows);
        $version_links->saveData();
    }
}
