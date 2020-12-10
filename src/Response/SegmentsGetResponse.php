<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi\Response;

use Pzelant\ExpertSenderApi\Model\SegmentsGetResponse\Segment;
use Pzelant\ExpertSenderApi\SpecificXmlMethodResponse;

/**
 * Segments GET response
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class SegmentsGetResponse extends SpecificXmlMethodResponse
{
    /**
     * Get segments
     *
     * @return Segment[] Segments
     */
    public function getSegments(): array
    {
        $nodes = $this->getSimpleXml()->xpath('/ApiResponse/Data/Segments/Segment');
        $segments = [];
        foreach ($nodes as $node) {
            $segments[] = new Segment(
                (int)$node->Id,
                (string)$node->Name
            );
        }

        return $segments;
    }
}
