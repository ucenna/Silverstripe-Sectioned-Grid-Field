<?php
namespace Ucenna\SectionedGridField;
use SilverStripe\View\HTML;
use SilverStripe\View\SSViewer;
use SilverStripe\Forms\GridField\GridFieldDataColumns;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig;
use SilverStripe\Forms\GridField\GridFieldConfig_Base;
use SilverStripe\Forms\GridField\GridField_HtmlProvider;
use Ucenna\SectionedGridField\GridFieldConfig_Min;
/**
 * Adding this class to a {@link GridFieldConfig} of a {@link GridField} adds
 * a header title to that field.
 *
 * The header serves to display the name of the data the GridField is showing.
 */
class GridFieldSubGrid implements GridField_RowProvider
{
    /**
     * @param GridField $gridField
     * @return array
     */

     /**
      * @var string
      * child grid to expand
      */
     protected $child = null;

     /**
      * @var GridFieldConfig
      */
     protected $config = null;

     public function __construct($child, GridFieldConfig $config = null)
     {
       $this->child = $child;

       if (!$config) {
            $config = GridFieldConfig_Min::create();
       }

       $this->setConfig($config);
     }

     /**
      * @return $this->child
      */
     public function getChild()
     {
       return $this->child;
     }

     /**
      * @param string $child
      */
     public function setChild($child)
     {
       $this->child = $child;
     }

     /**
      * @return $this->config
      */
     public function getConfig()
     {
       return $this->config;
     }

     /**
      * @param GridFieldConfig $config
      */
     public function setConfig(GridFieldConfig $config)
     {
       $this->config = $config;
     }

     public function getFieldList($gridField)
     {
       $list = $gridField->getList();
       $displayList = '';
       foreach ($list as $key => $item)
       {

         $displayList .= $this->getChildFieldList($gridField, $item, $key);
       }
       return $displayList;
     }

     public function getChildFieldList($gridField, $item, $key)
     {
       $list = $item->getComponents($this->child);
       $grid = GridField::create(
         $gridField->name.'/item/'.$item->ID.'/ItemEditForm/field/'.$this->child,
         $this->child,
         $list,
         $this->config
       );
       $grid->setForm($gridField->form);
       return $grid->FieldHolder();
     }

     public function getRowHTMLFragments($gridField, $item, $key)
     {
       $RowData = HTML::createTag(
         'td',
         [
           'class' => "subgrid",
           'colspan' => $gridField->getColumnCount(),
           'style' => 'padding: 2% 10%;'
         ],
         $this->getChildFieldList($gridField, $item, $key)
       );

       $after_row = HTML::createTag(
         'tr',
         [
           'style' => 'background-color: #f7f8fa;'
         ],
         $RowData
       );



       return array(
           'after_row' => $after_row,
         );
     }
}
