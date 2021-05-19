<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Response;

use Bridit\ExpertSenderApi\Model\SegmentsGetResponse\Segment;
use Bridit\ExpertSenderApi\SpecificXmlMethodResponse;

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
