<?php
namespace Ucenna\SectionedGridField;
use SilverStripe\Forms\GridField\GridFieldConfig;
use SilverStripe\Forms\GridField\GridFieldEditButton;
use SilverStripe\Forms\GridField\GridFieldButtonRow;
use SilverStripe\Forms\GridField\GridFieldDetailForm;
use SilverStripe\Forms\GridField\GridFieldDataColumns;
use SilverStripe\Forms\GridField\GridFieldDeleteAction;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use SilverStripe\Forms\GridField\GridFieldToolbarHeader;
use SilverStripe\Forms\GridField\GridFieldSortableHeader;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Versioned\Versioned;
/**
 * A simple readonly, paginated view of records, with sortable and searchable
 * headers.
 */
class GridFieldConfig_ManyEditor extends GridFieldConfig
{
    /**
     * @param string $childlist - name of childlist to expand
     */
    public function __construct($childlist)
    {
        parent::__construct();
        $this->addComponent(new GridFieldToolbarHeader());
        $this->addComponent(new GridFieldButtonRow('before'));
        $this->addComponent(new GridFieldAddNewButton('buttons-before-left'));
        $this->addComponent(new GridFieldSortableHeader());
        $this->addComponent(new GridFieldDataColumns());
        $this->addComponent(new GridFieldEditButton());
        $this->addComponent(new GridFieldDeleteAction());
        $this->addComponent(new GridFieldDetailForm());
        $this->addComponent(new GridFieldSubGrid($childlist));
        //$this->addComponent(new GridFieldSubGrid($childlist));
    }
}
