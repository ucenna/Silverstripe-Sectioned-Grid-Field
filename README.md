# Silverstripe-Sectioned-Grid-Field

## Usage ##
Sectioned GridField extends the GridField class, albiet with added functionality to allow components to modify//expand grid rows. Configuration is more or less the same between the two.
```php
$fields->addFieldToTab('Root.Regions', SectionedGridField::create(
 'Regions',
 'Region',
 $this->Regions(),
 new GridFieldConfig_ManyEditor('Items')
));
```
`GridFieldConfig_ManyEditor` is a GridFieldConfig that implements the `GridFieldSubGrid` component and takes a `$has_many` or `many_many` to parse into a child GridField. It can optionally be passed a GridFieldConfig that will be used to parse the child GridField like so: `new GridFieldConfig_ManyEditor('Items', new GridFieldConfig_RecordEditor()`

