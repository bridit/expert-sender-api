<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Traits;

use Bridit\ExpertSenderApi\Model\Column;

/**
 * Column to xml converter trait
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
trait ColumnToXmlConverterTrait
{
    /**
     * Converts column to xml element <column>
     *
     * @param Column $column Column
     * @param \XMLWriter $xmlWriter Xml writer
     */
    protected function convertColumnToXml(Column $column, \XMLWriter $xmlWriter): void
    {
        $xmlWriter->startElement('Column');
        $xmlWriter->writeElement('Name', $column->getName());
        $value = $column->getValue();
        if ($value === null) {
            $xmlWriter->startElement('Value');
            $xmlWriter->writeAttributeNS('xsi', 'nil', null, 'true');
            $xmlWriter->endElement(); // Value
        } else {
            $xmlWriter->writeElement('Value', $column->getValue());
        }

        $xmlWriter->endElement(); // Column
    }
}
