<?php

namespace App\Services;

use App\Repositories\FaqResponseRepository;
use App\Models\FaqResponse;
use App\Models\Faq;

class FaqResponseService
{
   protected $faqResponseRepo;

    public function __construct(FaqResponseRepository $faqResponseRepo)
    {
        $this->faqResponseRepo = $faqResponseRepo;
    }

 public function storeOrUpdateResponses($applicantId, array $answers)
{
    $responseData = [];

    foreach ($answers as $faqId => $answer) {
        $faq = Faq::find($faqId);
        if ($faq) {
            $responseData[$faqId] = [
                'question' => $faq->question,
                'answer'   => $answer
            ];
        }
    }

    // Update or create a single row for this applicant
    return FaqResponse::updateOrCreate(
        ['applicant_id' => $applicantId],
        ['responses' => json_encode($responseData)]
    );
}


}
