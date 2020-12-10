<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi\Traits;

use Pzelant\ExpertSenderApi\Model\WhereCondition;

/**
 * Where condition to xml converter trait
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
trait WhereConditionToXmlConverterTrait
{
    /**
     * Convert where condition into xml
     *
     * @param WhereCondition $whereCondition Where condition
     * @param \XMLWriter $xmlWriter Xml writer
     */
    public function convertWhereConditionToXml(WhereCondition $whereCondition, \XMLWriter $xmlWriter)
    {
        $xmlWriter->startElement('Where');
        $xmlWriter->writeElement('ColumnName', $whereCondition->getColumnName());
        $xmlWriter->writeElement('Operator', $whereCondition->getOperator()->getValue());
        $xmlWriter->writeElement('Value', $whereCondition->getValue());
        $xmlWriter->endElement(); // Where
    }
}
