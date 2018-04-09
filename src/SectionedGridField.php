<?php
namespace Ucenna\SectionedGridField;

use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\View\HTML;
use SilverStripe\ORM\SS_List;

/**
 * SectionedGridField
 */
class SectionedGridField extends GridField {
  /**
     * @param int $total
     * @param int $index
     * @param DataObject $record
     * @param array $attributes
     * @param string $content
     *
     * @return string
     */

    protected function newRow($total, $index, $record, $attributes, $content)
    {
      $beforeRow = $afterRow = '';
      foreach ($this->getComponents() as $item)
      {
          if ($item instanceof GridField_RowProvider)
          {
              $griditem = $this->getList()[$index];
              $mycontent = $item->getRowHTMLFragments($this, $griditem, $index);
              if(array_key_exists('before_row', $mycontent))
              {
                $beforeRow .= $mycontent['before_row'];
              }
              if(array_key_exists('after_row', $mycontent))
              {
                $afterRow .= $mycontent['after_row'];
              }
          }
      }

      $row = HTML::createTag(
          'tr',
          $attributes,
          $content
      );

      $allRows = $beforeRow.$row.$afterRow;
      return $allRows;
    }

    public function getManipulatedList()
    {
        return $this->getList();
    }
}
