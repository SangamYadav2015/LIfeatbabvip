<?php

namespace App\Services;

use App\Repositories\PageSectionRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\PageSection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PageSectionService
{
    protected $pageSetionRepository;

    public function __construct(PageSectionRepository $pageSetionRepository)
    {
        $this->pageSetionRepository = $pageSetionRepository;
    }


    public function list()
    {
        return $this->pageSetionRepository->list();
    }


    public function create(array $sectionData)
    {
        return $this->pageSetionRepository->create($sectionData);
    }
    public function insert(array $sectionData)
    {
        return $this->pageSetionRepository->insert($sectionData);
    }

    public function updateSave($id, array $sectionData)
    {
        return $this->pageSetionRepository->updateData($id, $sectionData);
    }
    public function update(array $data, $id)
    {
        return $this->pageSetionRepository->update($data, $id);
    }



    public function singleDataFindId($id)
    {
        return $this->pageSetionRepository->find($id);
    }




    public function delete($id)
    {
        return $this->pageSetionRepository->delete($id);
    }

    public function prepareHeroSectionstyle1($data)
    {
        if (!empty($data['banner_bg_image'])) {
            $banner_bg_image = $this->upload($data['banner_bg_image']);
            $data['banner_bg_image'] = $banner_bg_image;

            if (isset($data['banner_bg_image_old'])) {
                $this->deleteImage($data['banner_bg_image_old']);
            }
        } else {
            $data['banner_bg_image'] = $data['banner_bg_image_old'];
        }

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        return $storeData;
    }

    public function prepareHeroSectionstyle2($data)
    {
        if (!empty($data['banner_image'])) {
            $banner_image = $this->upload($data['banner_image']);
            $data['banner_image'] = $banner_image;
            if (isset($data['banner_image_old'])) {
                $this->deleteImage($data['banner_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_image_old'];
        }
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        $topClientImages = [];
        if (!empty($data['top_client_image'])) {
            foreach ($data['top_client_image'] as $i => $clientImg) {
                $topClientImages[] = [
                    'top_client_image' => $this->upload($clientImg),
                    'icon_alt_tag' => $data['icon_alt_tag'][$i],
                ];
            }
            $data['top_client_image'] = $topClientImages;
        } else {
            if (!empty($data['top_client_image_old'])) {
                foreach ($data['top_client_image_old'] as $i => $clientImg) {
                    $topClientImages[] = [
                        'top_client_image' => $data['top_client_image_old'][$i],
                        'icon_alt_tag' => $data['icon_alt_tag'][$i],
                    ];
                }
                $data['top_client_image'] = $topClientImages;
            }
        }
        unset($data['icon_alt_tag']);

        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        return $storeData;
    }



    public function prepareHeroSectionstyle3($data)
    {
        if (!empty($data['banner_bg_image'])) {
            $bannerBgImage = $this->upload($data['banner_bg_image']);
            $data['banner_bg_image'] = $bannerBgImage;
            if (isset($data['banner_bg_image_old'])) {
                $this->deleteImage($data['banner_bg_image_old']);
            }
        } else {
            $data['banner_bg_image'] = $data['banner_bg_image_old'];
        }

        if (!empty($data['banner_image1'])) {
            $bannerImage1 = $this->upload($data['banner_image1']);
            $data['banner_image1'] = $bannerImage1;
            if (isset($data['banner_image1_old'])) {
                $this->deleteImage($data['banner_image1_old']);
            }
        } else {
            $data['banner_image1'] = $data['banner_image1_old'];
        }
        if (!empty($data['banner_image2'])) {
            $bannerImage2 = $this->upload($data['banner_image2']);
            $data['banner_image2'] = $bannerImage2;
            if (isset($data['banner_image2_old'])) {
                $this->deleteImage($data['banner_image2_old']);
            }
        } else {
            $data['banner_image2'] = $data['banner_image2_old'];
        }
        if (!empty($data['banner_image3'])) {

            $bannerImage3 = $this->upload($data['banner_image3']);
            $data['banner_image3'] = $bannerImage3;
            if (isset($data['banner_image3_old'])) {
                $this->deleteImage($data['banner_image3_old']);
            }
        } else {
            $data['banner_image3'] = $data['banner_image3_old'];
        }
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $client_review = [];

        foreach ($data['review_title'] as $i => $review) {

            if (!empty($data['review_image'][$i])) {
                $reviewImage = $this->upload($data['review_image'][$i]);
            } else {
                $reviewImage = $data['client_review_image_old'][$i];
            }
            $client_review[] = [
                'review_title' => $data['review_title'][$i],
                'image' => $reviewImage,
                'alt_tag' => $data['review_image_alt_tag'][$i],
                'link_text' => $data['link_text'][$i],
                'link_url' => $data['link_url'][$i],
                'review_description' => $data['review_description'][$i],
            ];
        }

        $data['review'] = $client_review;
        unset($data['review_title']);
        unset($data['review_image']);
        unset($data['review_image_alt_tag']);
        unset($data['link_text']);
        unset($data['link_url']);
        unset($data['review_description']);

        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        return $storeData;
    }


    public function prepareHeroSectionstyle4($data)
    {
        if (!empty($data['banner_bg_image'])) {
            $bannerBgImage = $this->upload($data['banner_bg_image']);
            $data['banner_bg_image'] = $bannerBgImage;
            if (isset($data['banner_bg_image_old'])) {
                $this->deleteImage($data['banner_bg_image_old']);
            }
        } else {
            $data['banner_bg_image'] = $data['banner_bg_image_old'];
        }

        if (!empty($data['banner_image1'])) {
            $bannerImage1 = $this->upload($data['banner_image1']);
            $data['banner_image1'] = $bannerImage1;
            if (isset($data['banner_image1_old'])) {
                $this->deleteImage($data['banner_image1_old']);
            }
        } else {
            $data['banner_image1'] = $data['banner_image1_old'];
        }
        if (!empty($data['banner_image2'])) {
            $bannerImage2 = $this->upload($data['banner_image2']);
            $data['banner_image2'] = $bannerImage2;
            if (isset($data['banner_image2_old'])) {
                $this->deleteImage($data['banner_image2_old']);
            }
        } else {
            $data['banner_image2'] = $data['banner_image2_old'];
        }


        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        return $storeData;
    }


    public function prepareHeroSectionstyle5($data)
    {
        if (!empty($data['banner_bg_image'])) {
            $bannerBgImage = $this->upload($data['banner_bg_image']);
            $data['banner_bg_image'] = $bannerBgImage;
            if (isset($data['banner_bg_image_old'])) {
                $this->deleteImage($data['banner_bg_image_old']);
            }
        } else {
            $data['banner_bg_image'] = $data['banner_bg_image_old'];
        }

        if (!empty($data['banner_image'])) {
            $bannerImage1 = $this->upload($data['banner_image']);
            $data['banner_image'] = $bannerImage1;
            if (isset($data['banner_image_old'])) {
                $this->deleteImage($data['banner_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_image_old'];
        }

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $topClientImages = [];
        if (!empty($data['top_client_image'])) {
            foreach ($data['top_client_image'] as $i => $clientImg) {
                $topClientImages[] = [
                    'top_client_image' => $this->upload($clientImg),
                    'icon_alt_tag' => $data['icon_alt_tag'][$i],
                ];
            }
            $data['top_client_image'] = $topClientImages;
        } else {
            if (!empty($data['top_client_image_old'])) {
                foreach ($data['top_client_image_old'] as $i => $clientImg) {
                    $topClientImages[] = [
                        'top_client_image' => $data['top_client_image_old'][$i],
                        'icon_alt_tag' => $data['icon_alt_tag'][$i],
                    ];
                }
                $data['top_client_image'] = $topClientImages;
            }
        }

        unset($data['icon_alt_tag']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        return $storeData;
    }
    public function prepareHeroSectionstyle6($data)
    {
        if (!empty($data['banner_bg_image'])) {
            $bannerBgImage = $this->upload($data['banner_bg_image']);
            $data['banner_bg_image'] = $bannerBgImage;
            if (isset($data['banner_bg_image_old'])) {
                $this->deleteImage($data['banner_bg_image_old']);
            }
        } else {
            $data['banner_bg_image'] = $data['banner_bg_image_old'];
        }

        if (!empty($data['banner_image1'])) {
            $bannerImage1 = $this->upload($data['banner_image1']);
            $data['banner_image1'] = $bannerImage1;
            if (isset($data['banner_image1_old'])) {
                $this->deleteImage($data['banner_image1_old']);
            }
        } else {
            $data['banner_image1'] = $data['banner_image1_old'];
        }

        if (!empty($data['banner_image2'])) {
            $bannerImage1 = $this->upload($data['banner_image2']);
            $data['banner_image2'] = $bannerImage1;
            if (isset($data['banner_image2_old'])) {
                $this->deleteImage($data['banner_image2_old']);
            }
        } else {
            $data['banner_image2'] = $data['banner_image2_old'];
        }
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        $topClientImages = [];
        if (!empty($data['top_client_image'])) {
            foreach ($data['top_client_image'] as $i => $clientImg) {
                $topClientImages[] = [
                    'top_client_image' => $this->upload($clientImg),
                    'icon_alt_tag' => $data['icon_alt_tag'][$i],
                ];
            }
            $data['top_client_image'] = $topClientImages;
        } else {
            if (!empty($data['top_client_image_old'])) {
                foreach ($data['top_client_image_old'] as $i => $clientImg) {
                    $topClientImages[] = [
                        'top_client_image' => $data['top_client_image_old'][$i],
                        'icon_alt_tag' => $data['icon_alt_tag'][$i],
                    ];
                }
                $data['top_client_image'] = $topClientImages;
            }
        }

        unset($data['icon_alt_tag']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        return $storeData;
    }


    public function prepareHeroSectionstyle7($data)
    {
        if (!empty($data['banner_bg_image'])) {
            $bannerBgImage = $this->upload($data['banner_bg_image']);
            $data['banner_bg_image'] = $bannerBgImage;
            if (isset($data['banner_bg_image_old'])) {
                $this->deleteImage($data['banner_bg_image_old']);
            }
        } else {
            $data['banner_bg_image'] = $data['banner_bg_image_old'];
        }

        if (!empty($data['banner_image1'])) {
            $bannerImage1 = $this->upload($data['banner_image1']);
            $data['banner_image1'] = $bannerImage1;
            if (isset($data['banner_image1_old'])) {
                $this->deleteImage($data['banner_image1_old']);
            }
        } else {
            $data['banner_image1'] = $data['banner_image1_old'];
        }

        if (!empty($data['banner_image2'])) {
            $bannerImage1 = $this->upload($data['banner_image2']);
            $data['banner_image2'] = $bannerImage1;
            if (isset($data['banner_image2_old'])) {
                $this->deleteImage($data['banner_image2_old']);
            }
        } else {
            $data['banner_image2'] = $data['banner_image2_old'];
        }

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        $topClientImages = [];
        if (!empty($data['top_client_image'])) {
            foreach ($data['top_client_image'] as $i => $clientImg) {
                $topClientImages[] = [
                    'top_client_image' => $this->upload($clientImg),
                    'icon_alt_tag' => $data['icon_alt_tag'][$i],
                ];
            }
            $data['top_client_image'] = $topClientImages;
        } else {
            if (!empty($data['top_client_image_old'])) {
                foreach ($data['top_client_image_old'] as $i => $clientImg) {
                    $topClientImages[] = [
                        'top_client_image' => $data['top_client_image_old'][$i],
                        'icon_alt_tag' => $data['icon_alt_tag'][$i],
                    ];
                }
                $data['top_client_image'] = $topClientImages;
            }
        }

        unset($data['icon_alt_tag']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        return $storeData;
    }


    public function prepareHeroSectionstyle8($data)
    {



        if (!empty($data['banner_image'])) {
            $bannerImage1 = $this->upload($data['banner_image']);
            $data['banner_image'] = $bannerImage1;
            if (isset($data['banner_image_old'])) {
                $this->deleteImage($data['banner_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_image_old'];
        }
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        $topClientImages = [];
        if (!empty($data['top_client_image'])) {
            foreach ($data['top_client_image'] as $i => $clientImg) {
                $topClientImages[] = [
                    'top_client_image' => $this->upload($clientImg),
                    'icon_alt_tag' => $data['icon_alt_tag'][$i],
                ];
            }
            $data['top_client_image'] = $topClientImages;
        } else {
            if (!empty($data['top_client_image_old'])) {
                foreach ($data['top_client_image_old'] as $i => $clientImg) {
                    $topClientImages[] = [
                        'top_client_image' => $data['top_client_image_old'][$i],
                        'icon_alt_tag' => $data['icon_alt_tag'][$i],
                    ];
                }
                $data['top_client_image'] = $topClientImages;
            }
        }

        unset($data['icon_alt_tag']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        return $storeData;
    }



    public function prepareHeroSectionstyle9($data)
    {



        if (!empty($data['banner_image'])) {
            $bannerImage1 = $this->upload($data['banner_image']);
            $data['banner_image'] = $bannerImage1;
            if (isset($data['banner_image_old'])) {
                $this->deleteImage($data['banner_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_image_old'];
        }

        if (!empty($data['banner_bg_image'])) {
            $banner_bg_image_old = $this->upload($data['banner_bg_image']);
            $data['banner_bg_image'] = $banner_bg_image_old;
            if (isset($data['banner_bg_image_old'])) {
                $this->deleteImage($data['banner_bg_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_bg_image_old'];
        }
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        $step_data = [];
        if (!empty($data['step_title'])) {
            foreach ($data['step_title'] as $i => $clientImg) {
                $step_data[] = [
                    'step_title' => $data['step_title'][$i],
                    'step_sub_title' => $data['step_sub_title'][$i],
                ];
            }
            $data['step_data'] = $step_data;
        }


        unset($data['step_title']);
        unset($data['step_sub_title']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        return $storeData;
    }


    public function prepareHeroSectionstyle10($data)
    {
        if (!empty($data['banner_bg_image'])) {
            $banner_bg_image_old = $this->upload($data['banner_bg_image']);
            $data['banner_bg_image'] = $banner_bg_image_old;
            if (isset($data['banner_bg_image_old'])) {
                $this->deleteImage($data['banner_bg_image_old']);
            }
        } else {
            $data['banner_bg_image'] = $data['banner_bg_image_old'];
        }
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        return $storeData;
    }



    public function prepareHeroSectionstyle11($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        return $storeData;
    }

    public function prepareHeroSectionstyle12($data)
    {
        if (!empty($data['banner_bg_image'])) {
            $banner_bg_image_old = $this->upload($data['banner_bg_image']);
            $data['banner_bg_image'] = $banner_bg_image_old;
            if (isset($data['banner_bg_image_old'])) {
                $this->deleteImage($data['banner_bg_image_old']);
            }
        } else {
            $data['banner_bg_image'] = $data['banner_bg_image_old'];
        }


        if (!empty($data['banner_image'])) {
            $banner_image = $this->upload($data['banner_image']);
            $data['banner_image'] = $banner_image;
            if (isset($data['banner_image_old'])) {
                $this->deleteImage($data['banner_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_image_old'];
        }


        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        return $storeData;
    }

    public function prepareHeroSectionstyle13($data)
    {
        if (!empty($data['banner_bg_image'])) {
            $banner_bg_image_old = $this->upload($data['banner_bg_image']);
            $data['banner_bg_image'] = $banner_bg_image_old;
            if (isset($data['banner_bg_image_old'])) {
                $this->deleteImage($data['banner_bg_image_old']);
            }
        } else {
            $data['banner_bg_image'] = $data['banner_bg_image_old'];
        }


        if (!empty($data['banner_image'])) {
            $banner_image = $this->upload($data['banner_image']);
            $data['banner_image'] = $banner_image;
            if (isset($data['banner_image_old'])) {
                $this->deleteImage($data['banner_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_image_old'];
        }


        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        return $storeData;
    }


    public function prepareHeroSectionstyle15($data)
    {
        if (!empty($data['banner_image'])) {
            $banner_image = $this->upload($data['banner_image']);
            $data['banner_image'] = $banner_image;
            if (isset($data['banner_image_old'])) {
                $this->deleteImage($data['banner_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_image_old'];
        }


        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        return $storeData;
    }

    public function prepareHeroSectionstyle16($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $stepData = [];
        foreach ($data['title'] as $i => $review) {

            if (!empty($data['step_image'][$i])) {
                $stepImage = $this->upload($data['step_image'][$i]);

                if (isset($data['step_image_old'])) {
                    $this->deleteImage($data['step_image_old'][$i]);
                }
            } else {
                $stepImage = $data['step_image_old'][$i];
            }


            $stepData[] = [
                'title' => $data['title'][$i],
                'highlighted_title' => $data['highlighted_title'][$i],
                'description' => $data['description'][$i],
                'button_text' => $data['button_text'][$i],
                'button_link' => $data['button_link'][$i],
                'step_image' => $stepImage,
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['title']);
        unset($data['highlighted_title']);
        unset($data['description']);
        unset($data['button_text']);
        unset($data['button_link']);
        unset($data['step_image']);

        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        return $storeData;
    }

    public function prepareHeroSectionstyle17($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        if (!empty($data['banner_bg_image'])) {
            $banner_bg_image_old = $this->upload($data['banner_bg_image']);
            $data['banner_bg_image'] = $banner_bg_image_old;
            if (isset($data['banner_bg_image_old'])) {
                $this->deleteImage($data['banner_bg_image_old']);
            }
        } else {
            $data['banner_bg_image'] = $data['banner_bg_image_old'];
        }

        if (!empty($data['banner_image'])) {
            $banner_image = $this->upload($data['banner_image']);
            $data['banner_image'] = $banner_image;
            if (isset($data['banner_image_old'])) {
                $this->deleteImage($data['banner_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_image_old'];
        }

        if (!empty($data['banner_image1'])) {
            $bannerImage1 = $this->upload($data['banner_image1']);
            $data['banner_image1'] = $bannerImage1;
            if (isset($data['banner_image1_old'])) {
                $this->deleteImage($data['banner_image1_old']);
            }
        } else {
            $data['banner_image1'] = $data['banner_image1_old'];
        }




        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareHeroSectionstyle18($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);


        if (!empty($data['banner_image'])) {
            $banner_image = $this->upload($data['banner_image']);
            $data['banner_image'] = $banner_image;
            if (isset($data['banner_image_old'])) {
                $this->deleteImage($data['banner_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_image_old'];
        }

        if (!empty($data['image1'])) {
            $banner_image = $this->upload($data['image1']);
            $data['image1'] = $banner_image;
            if (isset($data['image1_old'])) {
                $this->deleteImage($data['image1_old']);
            }
        } else {
            $data['image1'] = $data['image1_old'];
        }

        if (!empty($data['image2'])) {
            $banner_image = $this->upload($data['image2']);
            $data['image2'] = $banner_image;
            if (isset($data['image2_old'])) {
                $this->deleteImage($data['image2_old']);
            }
        } else {
            $data['image2'] = $data['image2_old'];
        }

        if (!empty($data['image3'])) {
            $banner_image = $this->upload($data['image3']);
            $data['image3'] = $banner_image;
            if (isset($data['image3_old'])) {
                $this->deleteImage($data['image3_old']);
            }
        } else {
            $data['image3'] = $data['image3_old'];
        }

        if (!empty($data['image4'])) {
            $banner_image = $this->upload($data['image4']);
            $data['image4'] = $banner_image;
            if (isset($data['image4_old'])) {
                $this->deleteImage($data['image4_old']);
            }
        } else {
            $data['image4'] = $data['image4_old'];
        }




        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }



    public function prepareHeroSectionstyle19($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);


        if (!empty($data['banner_image'])) {
            $banner_image = $this->upload($data['banner_image']);
            $data['banner_image'] = $banner_image;
            if (isset($data['banner_image_old'])) {
                $this->deleteImage($data['banner_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_image_old'];
        }


        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function prepareHeroSectionstyle20($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);


        if (!empty($data['banner_image'])) {
            $banner_image = $this->upload($data['banner_image']);
            $data['banner_image'] = $banner_image;
            if (isset($data['banner_image_old'])) {
                $this->deleteImage($data['banner_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_image_old'];
        }


        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function prepareHeroSectionstyle21($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);


        if (!empty($data['banner_image'])) {
            $banner_image = $this->upload($data['banner_image']);
            $data['banner_image'] = $banner_image;
            if (isset($data['banner_image_old'])) {
                $this->deleteImage($data['banner_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_image_old'];
        }

        if (!empty($data['image1'])) {
            $banner_image = $this->upload($data['image1']);
            $data['image1'] = $banner_image;
            if (isset($data['image1_old'])) {
                $this->deleteImage($data['image1_old']);
            }
        } else {
            $data['image1'] = $data['image1_old'];
        }


        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareHeroSectionstyle22($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);


        if (!empty($data['banner_image'])) {
            $banner_image = $this->upload($data['banner_image']);
            $data['banner_image'] = $banner_image;
            if (isset($data['banner_image_old'])) {
                $this->deleteImage($data['banner_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_image_old'];
        }

        if (!empty($data['image1'])) {
            $banner_image = $this->upload($data['image1']);
            $data['image1'] = $banner_image;
            if (isset($data['image1_old'])) {
                $this->deleteImage($data['image1_old']);
            }
        } else {
            $data['image1'] = $data['image1_old'];
        }


        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function prepareHeroSectionstyle23($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);


        if (!empty($data['banner_image'])) {
            $banner_image = $this->upload($data['banner_image']);
            $data['banner_image'] = $banner_image;
            if (isset($data['banner_image_old'])) {
                $this->deleteImage($data['banner_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_image_old'];
        }

        if (!empty($data['image1'])) {
            $banner_image = $this->upload($data['image1']);
            $data['image1'] = $banner_image;
            if (isset($data['image1_old'])) {
                $this->deleteImage($data['image1_old']);
            }
        } else {
            $data['image1'] = $data['image1_old'];
        }

        if (!empty($data['image2'])) {
            $banner_image = $this->upload($data['image2']);
            $data['image2'] = $banner_image;
            if (isset($data['image2_old'])) {
                $this->deleteImage($data['image2_old']);
            }
        } else {
            $data['image2'] = $data['image2_old'];
        }


        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareHeroSectionstyle24($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);


        if (!empty($data['banner_image'])) {
            $banner_image = $this->upload($data['banner_image']);
            $data['banner_image'] = $banner_image;
            if (isset($data['banner_image_old'])) {
                $this->deleteImage($data['banner_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_image_old'];
        }



        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function prepareHeroSectionstyle25($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);


        if (!empty($data['banner_image'])) {
            $banner_image = $this->upload($data['banner_image']);
            $data['banner_image'] = $banner_image;
            if (isset($data['banner_image_old'])) {
                $this->deleteImage($data['banner_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_image_old'];
        }

        if (!empty($data['image1'])) {
            $banner_image = $this->upload($data['image1']);
            $data['image1'] = $banner_image;
            if (isset($data['image1_old'])) {
                $this->deleteImage($data['image1_old']);
            }
        } else {
            $data['image1'] = $data['image1_old'];
        }

        if (!empty($data['image2'])) {
            $banner_image = $this->upload($data['image2']);
            $data['image2'] = $banner_image;
            if (isset($data['image2_old'])) {
                $this->deleteImage($data['image2_old']);
            }
        } else {
            $data['image2'] = $data['image2_old'];
        }


        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function prepareHeroSectionstyle26($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);


        if (!empty($data['banner_image'])) {
            $banner_image = $this->upload($data['banner_image']);
            $data['banner_image'] = $banner_image;
            if (isset($data['banner_image_old'])) {
                $this->deleteImage($data['banner_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_image_old'];
        }

        if (!empty($data['image1'])) {
            $banner_image = $this->upload($data['image1']);
            $data['image1'] = $banner_image;
            if (isset($data['image1_old'])) {
                $this->deleteImage($data['image1_old']);
            }
        } else {
            $data['image1'] = $data['image1_old'];
        }

        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function prepareHeroSectionstyle27($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);


        if (!empty($data['banner_image'])) {
            $banner_image = $this->upload($data['banner_image']);
            $data['banner_image'] = $banner_image;
            if (isset($data['banner_image_old'])) {
                $this->deleteImage($data['banner_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_image_old'];
        }

        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareHeroSectionstyle28($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);


        if (!empty($data['banner_image'])) {
            $banner_image = $this->upload($data['banner_image']);
            $data['banner_image'] = $banner_image;
            if (isset($data['banner_image_old'])) {
                $this->deleteImage($data['banner_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_image_old'];
        }

        if (!empty($data['image1'])) {
            $banner_image = $this->upload($data['image1']);
            $data['image1'] = $banner_image;
            if (isset($data['image1_old'])) {
                $this->deleteImage($data['image1_old']);
            }
        } else {
            $data['image1'] = $data['image1_old'];
        }

        if (!empty($data['image2'])) {
            $banner_image = $this->upload($data['image2']);
            $data['image2'] = $banner_image;
            if (isset($data['image2_old'])) {
                $this->deleteImage($data['image2_old']);
            }
        } else {
            $data['image2'] = $data['image2_old'];
        }

        if (!empty($data['image3'])) {
            $banner_image = $this->upload($data['image3']);
            $data['image3'] = $banner_image;
            if (isset($data['image3_old'])) {
                $this->deleteImage($data['image3_old']);
            }
        } else {
            $data['image3'] = $data['image3_old'];
        }

        if (!empty($data['image4'])) {
            $banner_image = $this->upload($data['image4']);
            $data['image4'] = $banner_image;
            if (isset($data['image4_old'])) {
                $this->deleteImage($data['image4_old']);
            }
        } else {
            $data['image4'] = $data['image4_old'];
        }

        if (!empty($data['image5'])) {
            $banner_image = $this->upload($data['image5']);
            $data['image5'] = $banner_image;
            if (isset($data['image5_old'])) {
                $this->deleteImage($data['image5_old']);
            }
        } else {
            $data['image5'] = $data['image5_old'];
        }

        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function prepareHeroSectionstyle29($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);


        if (!empty($data['banner_image'])) {
            $banner_image = $this->upload($data['banner_image']);
            $data['banner_image'] = $banner_image;
            if (isset($data['banner_image_old'])) {
                $this->deleteImage($data['banner_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_image_old'];
        }

        if (!empty($data['image1'])) {
            $banner_image = $this->upload($data['image1']);
            $data['image1'] = $banner_image;
            if (isset($data['image1_old'])) {
                $this->deleteImage($data['image1_old']);
            }
        } else {
            $data['image1'] = $data['image1_old'];
        }

        $step_data = [];
        if (!empty($data['step_title'])) {
            foreach ($data['step_title'] as $i => $clientImg) {
                $step_data[] = [
                    'step_title' => $data['step_title'][$i],
                    'step_sub_title' => $data['step_sub_title'][$i],
                ];
            }
            $data['step_data'] = $step_data;
        }


        unset($data['step_title']);
        unset($data['step_sub_title']);


        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareHeroSectionstyle30($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        if (!empty($data['banner_image'])) {
            $banner_image = $this->upload($data['banner_image']);
            $data['banner_image'] = $banner_image;
            if (isset($data['banner_image_old'])) {
                $this->deleteImage($data['banner_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_image_old'];
        }

        $stepData = [];
        foreach ($data['step_image_alt_tag'] as $i => $review) {

            if (!empty($data['step_image'][$i])) {
                $stepImage = $this->upload($data['step_image'][$i]);
            } else {
                $stepImage = $data['step_image_old'][$i];
            }
            $stepData[] = [
                'step_image' => $stepImage,
                'step_image_alt_tag' => $data['step_image_alt_tag'][$i],
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_image_alt_tag']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function prepareHeroSectionstyle33($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        if (!empty($data['banner_bg_image'])) {
            $banner_bg_image_old = $this->upload($data['banner_bg_image']);
            $data['banner_bg_image'] = $banner_bg_image_old;
            if (isset($data['banner_bg_image_old'])) {
                $this->deleteImage($data['banner_bg_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_bg_image_old'];
        }

        if (!empty($data['banner_image'])) {
            $banner_image = $this->upload($data['banner_image']);
            $data['banner_image'] = $banner_image;
            if (isset($data['banner_image_old'])) {
                $this->deleteImage($data['banner_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_image_old'];
        }

        if (!empty($data['image1'])) {
            $banner_image = $this->upload($data['image1']);
            $data['image1'] = $banner_image;
            if (isset($data['image1_old'])) {
                $this->deleteImage($data['image1_old']);
            }
        } else {
            $data['image1'] = $data['image1_old'];
        }
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function prepareHeroSectionstyle34($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        if (!empty($data['banner_bg_image'])) {
            $banner_bg_image_old = $this->upload($data['banner_bg_image']);
            $data['banner_bg_image'] = $banner_bg_image_old;
            if (isset($data['banner_bg_image_old'])) {
                $this->deleteImage($data['banner_bg_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_bg_image_old'];
        }

        if (!empty($data['banner_image'])) {
            $banner_image = $this->upload($data['banner_image']);
            $data['banner_image'] = $banner_image;
            if (isset($data['banner_image_old'])) {
                $this->deleteImage($data['banner_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_image_old'];
        }

        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareHeroSectionstyle35($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $stepData = [];
        foreach ($data['step_image_alt_tag'] as $i => $review) {

            if (!empty($data['step_image'][$i])) {
                $stepImage = $this->upload($data['step_image'][$i]);
            } else {
                $stepImage = $data['step_image_old'][$i];
            }
            $stepData[] = [
                'step_image' => $stepImage,
                'step_image_alt_tag' => $data['step_image_alt_tag'][$i],
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_image_alt_tag']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function prepareHeroSectionstyle36($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        if (!empty($data['banner_image'])) {
            $banner_image = $this->upload($data['banner_image']);
            $data['banner_image'] = $banner_image;
            if (isset($data['banner_image_old'])) {
                $this->deleteImage($data['banner_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_image_old'];
        }


        if (!empty($data['image1'])) {
            $banner_image = $this->upload($data['image1']);
            $data['image1'] = $banner_image;
            if (isset($data['image1_old'])) {
                $this->deleteImage($data['image1_old']);
            }
        } else {
            $data['image1'] = $data['image1_old'];
        }

        $stepData = [];
        foreach ($data['step_image_alt_tag'] as $i => $review) {

            if (!empty($data['step_image'][$i])) {
                $stepImage = $this->upload($data['step_image'][$i]);
            } else {
                $stepImage = $data['step_image_old'][$i];
            }
            $stepData[] = [
                'step_image' => $stepImage,
                'step_image_alt_tag' => $data['step_image_alt_tag'][$i],
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_image_alt_tag']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareHeroSectionstyle37($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        if (!empty($data['banner_image'])) {
            $banner_image = $this->upload($data['banner_image']);
            $data['banner_image'] = $banner_image;
            if (isset($data['banner_image_old'])) {
                $this->deleteImage($data['banner_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_image_old'];
        }
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function prepareHeroSectionstyle38($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        if (!empty($data['banner_bg_image'])) {
            $banner_bg_image = $this->upload($data['banner_image']);
            $data['banner_bg_image'] = $banner_bg_image;
            if (isset($data['banner_bg_image_old'])) {
                $this->deleteImage($data['banner_bg_image_old']);
            }
        } else {
            $data['banner_bg_image'] = $data['banner_bg_image_old'];
        }

        if (!empty($data['banner_image'])) {
            $banner_image = $this->upload($data['banner_image']);
            $data['banner_image'] = $banner_image;
            if (isset($data['banner_image_old'])) {
                $this->deleteImage($data['banner_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_image_old'];
        }

        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareHeroSectionstyle39($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);


        if (!empty($data['banner_image'])) {
            $banner_image = $this->upload($data['banner_image']);
            $data['banner_image'] = $banner_image;
            if (isset($data['banner_image_old'])) {
                $this->deleteImage($data['banner_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_image_old'];
        }
        if (!empty($data['image1'])) {
            $banner_image = $this->upload($data['image1']);
            $data['image1'] = $banner_image;
            if (isset($data['image1_old'])) {
                $this->deleteImage($data['image1_old']);
            }
        } else {
            $data['image1'] = $data['image1_old'];
        }

        if (!empty($data['image2'])) {
            $banner_image = $this->upload($data['image2']);
            $data['image2'] = $banner_image;
            if (isset($data['image2_old'])) {
                $this->deleteImage($data['image2_old']);
            }
        } else {
            $data['image2'] = $data['image2_old'];
        }

        if (!empty($data['image3'])) {
            $banner_image = $this->upload($data['image3']);
            $data['image3'] = $banner_image;
            if (isset($data['image3_old'])) {
                $this->deleteImage($data['image3_old']);
            }
        } else {
            $data['image3'] = $data['image3_old'];
        }

        if (!empty($data['image4'])) {
            $banner_image = $this->upload($data['image4']);
            $data['image4'] = $banner_image;
            if (isset($data['image4_old'])) {
                $this->deleteImage($data['image4_old']);
            }
        } else {
            $data['image4'] = $data['image4_old'];
        }

        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function prepareHeroSectionstyle40($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);


        if (!empty($data['image1'])) {
            $banner_image = $this->upload($data['image1']);
            $data['image1'] = $banner_image;
            if (isset($data['image1_old'])) {
                $this->deleteImage($data['image1_old']);
            }
        } else {
            $data['image1'] = $data['image1_old'];
        }

        if (!empty($data['image2'])) {
            $banner_image = $this->upload($data['image2']);
            $data['image2'] = $banner_image;
            if (isset($data['image2_old'])) {
                $this->deleteImage($data['image2_old']);
            }
        } else {
            $data['image2'] = $data['image2_old'];
        }



        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    // start testimonial section//
    public function preparTestimoniSectionstyle1($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $client_review = [];

        foreach ($data['review_title'] as $i => $review) {

            if (!empty($data['client_image'][$i])) {
                $client_image = $this->upload($data['client_image'][$i]);
            } else {
                $client_image = $data['client_review_image_old'][$i];
            }
            $client_review[] = [
                'review_title' => $data['review_title'][$i],
                'image' => $client_image,
                'alt_tag' => $data['client_image_alt_tag'][$i],
                'client_name' => $data['client_name'][$i],
                'client_rating' => $data['client_rating'][$i],
                'designation' => $data['designation'][$i],
                'review_description' => $data['review_description'][$i],
            ];
        }

        $data['review'] = $client_review;
        unset($data['review_title']);
        unset($data['client_image']);
        unset($data['client_image_alt_tag']);
        unset($data['client_name']);
        unset($data['designation']);
        unset($data['client_rating']);
        unset($data['review_description']);

        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function preparTestimoniSectionstyle2($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $client_review = [];

        foreach ($data['review_title'] as $i => $review) {

            if (!empty($data['client_image'][$i])) {
                $client_image = $this->upload($data['client_image'][$i]);
            } else {
                $client_image = $data['client_review_image_old'][$i];
            }
            $client_review[] = [
                'review_title' => $data['review_title'][$i],
                'image' => $client_image,
                'alt_tag' => $data['client_image_alt_tag'][$i],
                'client_name' => $data['client_name'][$i],
                'client_rating' => $data['client_rating'][$i],
                'video_link' => $data['video_link'][$i],
                'designation' => $data['designation'][$i],
                'review_description' => $data['review_description'][$i],
            ];
        }

        $data['review'] = $client_review;
        unset($data['review_title']);
        unset($data['client_image']);
        unset($data['client_image_alt_tag']);
        unset($data['client_name']);
        unset($data['designation']);
        unset($data['client_rating']);
        unset($data['review_description']);
        unset($data['video_link']);

        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }



    public function preparTestimoniSectionstyle3($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $client_review = [];

        foreach ($data['review_title'] as $i => $review) {

            if (!empty($data['client_image'][$i])) {
                $client_image = $this->upload($data['client_image'][$i]);
            } else {
                $client_image = $data['client_review_image_old'][$i];
            }
            $client_review[] = [
                'review_title' => $data['review_title'][$i],
                'image' => $client_image,
                'alt_tag' => $data['client_image_alt_tag'][$i],
                'client_name' => $data['client_name'][$i],
                'client_rating' => $data['client_rating'][$i],
                'designation' => $data['designation'][$i],
                'review_description' => $data['review_description'][$i],
            ];
        }

        $data['review'] = $client_review;
        unset($data['review_title']);
        unset($data['client_image']);
        unset($data['client_image_alt_tag']);
        unset($data['client_name']);
        unset($data['designation']);
        unset($data['client_rating']);
        unset($data['review_description']);

        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }



    public function preparTestimoniSectionstyle4($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $client_review = [];

        foreach ($data['client_name'] as $i => $review) {

            if (!empty($data['step_image'][$i])) {
                $stepImage = $this->upload($data['step_image'][$i]);
            } else {
                $stepImage = $data['step_image_old'][$i];
            }
            if (!empty($data['client_image'][$i])) {
                $client_image = $this->upload($data['client_image'][$i]);
            } else {
                $client_image = $data['client_review_image_old'][$i];
            }
            $client_review[] = [
                'image' => $client_image,
                'client_image_alt_tag' => $data['client_image_alt_tag'][$i],
                'step_image' => $stepImage,
                'step_image_alt_tag' => $data['step_image_alt_tag'][$i],
                'client_name' => $data['client_name'][$i],
                'designation' => $data['designation'][$i],
                'review_description' => $data['review_description'][$i],
            ];
        }

        $data['review'] = $client_review;
        unset($data['client_image']);
        unset($data['client_image_alt_tag']);
        unset($data['client_name']);
        unset($data['designation']);
        unset($data['review_description']);
        unset($data['step_image']);
        unset($data['step_image_alt_tag']);

        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function preparTestimoniSectionstyle5($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $client_review = [];

        foreach ($data['client_name'] as $i => $review) {

            if (!empty($data['step_image'][$i])) {
                $stepImage = $this->upload($data['step_image'][$i]);
            } else {
                $stepImage = $data['step_image_old'][$i];
            }
            if (!empty($data['client_image'][$i])) {
                $client_image = $this->upload($data['client_image'][$i]);
            } else {
                $client_image = $data['client_review_image_old'][$i];
            }
            $client_review[] = [
                'image' => $client_image,
                'client_image_alt_tag' => $data['client_image_alt_tag'][$i],
                'step_image' => $stepImage,
                'step_image_alt_tag' => $data['step_image_alt_tag'][$i],
                'client_name' => $data['client_name'][$i],
                'review_description' => $data['review_description'][$i],
            ];
        }

        $data['review'] = $client_review;
        unset($data['client_image']);
        unset($data['client_image_alt_tag']);
        unset($data['client_name']);
        unset($data['review_description']);
        unset($data['step_image']);
        unset($data['step_image_alt_tag']);

        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function preparTestimoniSectionstyle6($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $client_review = [];

        foreach ($data['client_name'] as $i => $review) {

            if (!empty($data['client_image'][$i])) {
                $client_image = $this->upload($data['client_image'][$i]);
            } else {
                $client_image = $data['client_review_image_old'][$i];
            }
            $client_review[] = [
                'image' => $client_image,
                'client_image_alt_tag' => $data['client_image_alt_tag'][$i],
                'client_name' => $data['client_name'][$i],
                'designation' => $data['designation'][$i],
                'review_description' => $data['review_description'][$i],
            ];
        }

        $data['review'] = $client_review;
        unset($data['client_image']);
        unset($data['client_image_alt_tag']);
        unset($data['client_name']);
        unset($data['designation']);
        unset($data['review_description']);

        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }




    public function preparCalltoActionSectionstyle1($data)
    {
        if (!empty($data['image'])) {
            $image = $this->upload($data['image']);
            $data['image'] = $image;
        } else {
            $data['image'] = $data['image_old'];
        }
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $steps = [];
        foreach ($data['step_title'] as $i => $review) {
            $steps[] = [
                'step_title' => $data['step_title'][$i],
            ];
        }

        $data['steps'] = $steps;
        unset($data['step_title']);


        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        return $storeData;
    }


    public function preparCalltoActionSectionstyle2($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $steps = [];
        foreach ($data['step_title'] as $i => $review) {
            $steps[] = [
                'step_title' => $data['step_title'][$i],
                'step_description' => $data['step_description'][$i],
            ];
        }

        $data['steps'] = $steps;
        unset($data['step_title']);
        unset($data['step_description']);

        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        return $storeData;
    }

    public function preparCalltoActionSectionstyle3($data)
    {
        if (!empty($data['image'])) {
            $image = $this->upload($data['image']);
            $data['image'] = $image;
        } else {
            $data['image'] = $data['image_old'];
        }
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        return $storeData;
    }
    public function preparCalltoActionSectionstyle4($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $steps = [];
        foreach ($data['step_title'] as $i => $review) {
            $steps[] = [
                'step_title' => $data['step_title'][$i],
            ];
        }

        $data['steps'] = $steps;
        unset($data['step_title']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        return $storeData;
    }

    public function preparCalltoActionSectionstyle5($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $steps = [];
        foreach ($data['step_title'] as $i => $review) {
            $steps[] = [
                'step_title' => $data['step_title'][$i],
            ];
        }

        $data['steps'] = $steps;
        unset($data['step_title']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        return $storeData;
    }

    public function preparCalltoActionSectionstyle6($data)
    {

        if (!empty($data['banner_bg_image'])) {
            $banner_bg_image_old = $this->upload($data['banner_bg_image']);
            $data['banner_bg_image'] = $banner_bg_image_old;
            if (isset($data['banner_bg_image_old'])) {
                $this->deleteImage($data['banner_bg_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_bg_image_old'];
        }
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        $step_data = [];
        if (!empty($data['step_title'])) {
            foreach ($data['step_title'] as $i => $clientImg) {
                $step_data[] = [
                    'step_title' => $data['step_title'][$i],
                ];
            }
            $data['step_data'] = $step_data;
        }


        unset($data['step_title']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        return $storeData;
    }


    public function preparCalltoActionSectionstyle7($data)
    {


        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        if (!empty($data['image'])) {
            $banner_image = $this->upload($data['image']);
            $data['image'] = $banner_image;
            if (isset($data['image_old'])) {
                $this->deleteImage($data['image_old']);
            }
        } else {
            $data['image'] = $data['image_old'];
        }

        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        return $storeData;
    }


    public function preparCalltoActionSectionstyle8($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        return $storeData;
    }

    public function preparetabstyle1($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $tabData = [];
        foreach ($data['tab_title'] as $i => $review) {
            if (!empty($data['tab_image'][$i])) {
                $tabImage = $this->upload($data['tab_image'][$i]);
            } else {
                $tabImage = $data['tab_image_old'][$i];
            }
            $tabData[] = [
                'tab_title' => $data['tab_title'][$i],
                'tab_image_alt_tag' => $data['tab_image_alt_tag'][$i],
                'button_text' => $data['button_text'][$i],
                'button_url' => $data['button_url'][$i],
                'tab_description' => $data['tab_description'][$i],
                'tab_image' => $tabImage,
            ];
        }

        $data['tab_data'] = $tabData;

        unset($data['tab_title']);
        unset($data['image_alt_tag']);
        unset($data['button_text']);
        unset($data['button_url']);
        unset($data['tab_description']);
        unset($data['tab_image']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function preparetabstyle2($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $tabData = [];
        foreach ($data['tab_title'] as $i => $review) {
            if (!empty($data['tab_image'][$i])) {
                $tabImage = $this->upload($data['tab_image'][$i]);
            } else {
                $tabImage = $data['tab_image_old'][$i];
            }
            $tabData[] = [
                'tab_title' => $data['tab_title'][$i],
                'tab_image_alt_tag' => $data['tab_image_alt_tag'][$i],
                'button_text' => $data['button_text'][$i],
                'button_url' => $data['button_url'][$i],
                'tab_description' => $data['tab_description'][$i],
                'tab_image' => $tabImage,
            ];
        }

        $data['tab_data'] = $tabData;

        unset($data['tab_title']);
        unset($data['image_alt_tag']);
        unset($data['button_text']);
        unset($data['button_url']);
        unset($data['tab_description']);
        unset($data['tab_image']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }



    public function preparetabstyle3($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $tabData = [];
        foreach ($data['tab_title'] as $i => $review) {
            if (!empty($data['tab_image'][$i])) {
                $tabImage = $this->upload($data['tab_image'][$i]);
            } else {
                $tabImage = $data['tab_image_old'][$i];
            }
            $tabData[] = [
                'tab_main_title' => $data['tab_main_title'][$i],
                'tab_title' => $data['tab_title'][$i],
                'tab_image_alt_tag' => $data['tab_image_alt_tag'][$i],
                'button_text' => $data['button_text'][$i],
                'button_url' => $data['button_url'][$i],
                'tab_description' => $data['tab_description'][$i],
                'step1_text' => $data['step1_text'][$i],
                'step2_text' => $data['step2_text'][$i],
                'step3_text' => $data['step3_text'][$i],
                'tab_image' => $tabImage,
            ];
        }



        $data['tab_data'] = $tabData;

        unset($data['tab_title']);
        unset($data['image_alt_tag']);
        unset($data['button_text']);
        unset($data['button_url']);
        unset($data['tab_description']);
        unset($data['tab_image']);
        unset($data['step1_text']);
        unset($data['step2_text']);
        unset($data['step3_text']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function preparetabstyle4($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $tabData = [];
        foreach ($data['tab_title'] as $i => $review) {
            if (!empty($data['tab_image'][$i])) {

                $tabImage = $this->upload($data['tab_image'][$i]);
                if (isset($data['tab_image_old'][$i])) {
                    $this->deleteImage($data['tab_image_old'][$i]);
                }
            } else {
                $tabImage = $data['tab_image_old'][$i];
            }

            if (!empty($data['step_image_icon'][$i])) {

                $stepImageIcon = $this->upload($data['step_image_icon'][$i]);
                if (isset($data['step_image_icon_old'])) {
                    $this->deleteImage($data['step_image_icon_old'][$i]);
                }
            } else {
                $stepImageIcon = $data['step_image_icon_old'][$i];
            }


            $tabData[] = [
                'tab_main_title' => $data['tab_main_title'][$i],
                'tab_title' => $data['tab_title'][$i],
                'tab_image_alt_tag' => $data['tab_image_alt_tag'][$i],
                'tab_description' => $data['tab_description'][$i],
                'step1_text' => $data['step1_text'][$i],
                'step2_text' => $data['step2_text'][$i],
                'step3_text' => $data['step3_text'][$i],
                'tab_image' => $tabImage,
                'step_image_icon' => $stepImageIcon,
                'step_image_icon_alt_tag' => $data['step_image_icon_alt_tag'][$i],

            ];
        }
        $data['tab_data'] = $tabData;

        unset($data['tab_title']);
        unset($data['image_alt_tag']);
        unset($data['tab_description']);
        unset($data['tab_image']);
        unset($data['step1_text']);
        unset($data['step2_text']);
        unset($data['step3_text']);
        unset($data['step_image_icon']);
        unset($data['step_image_icon_alt_tag']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function preparetabstyle5($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $tabData = [];
        if (!empty($data['image1'])) {
            $banner_image = $this->upload($data['image1']);
            $data['image1'] = $banner_image;
            if (isset($data['image1_old'])) {
                $this->deleteImage($data['image1_old']);
            }
        } else {
            $data['image1'] = $data['image1_old'];
        }

        if (!empty($data['image2'])) {
            $banner_image = $this->upload($data['image2']);
            $data['image2'] = $banner_image;
            if (isset($data['image2_old'])) {
                $this->deleteImage($data['image2_old']);
            }
        } else {
            $data['image2'] = $data['image2_old'];
        }

        foreach ($data['tab_title'] as $i => $review) {
            if (!empty($data['tab_image'][$i])) {

                $tabImage = $this->upload($data['tab_image'][$i]);
                if (isset($data['tab_image_old'][$i])) {
                    $this->deleteImage($data['tab_image_old'][$i]);
                }
            } else {
                $tabImage = $data['tab_image_old'][$i];
            }

            if (!empty($data['step_image_icon'][$i])) {

                $stepImageIcon = $this->upload($data['step_image_icon'][$i]);
                if (isset($data['step_image_icon_old'])) {

                    $this->deleteImage($data['step_image_icon_old'][$i]);
                }
            } else {
                $stepImageIcon = $data['step_image_icon_old'][$i];
            }


            $tabData[] = [
                'tab_main_title' => $data['tab_main_title'][$i],
                'tab_title' => $data['tab_title'][$i],
                'tab_image_alt_tag' => $data['tab_image_alt_tag'][$i],
                'tab_description' => $data['tab_description'][$i],
                'step1_text' => $data['step1_text'][$i],
                'step2_text' => $data['step2_text'][$i],
                'button_text' => $data['button_text'][$i],
                'button_url' => $data['button_url'][$i],
                'tab_image' => $tabImage,
                'step_image_icon' => $stepImageIcon,
                'step_image_icon_alt_tag' => $data['step_image_icon_alt_tag'][$i],

            ];
        }
        $data['tab_data'] = $tabData;

        unset($data['tab_title']);
        unset($data['image_alt_tag']);
        unset($data['tab_description']);
        unset($data['tab_image']);
        unset($data['step1_text']);
        unset($data['step2_text']);
        unset($data['button_url']);
        unset($data['button_text']);
        unset($data['step_image_icon']);
        unset($data['step_image_icon_alt_tag']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


     public function preparetabstyle6($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $tabData = [];
       

        foreach ($data['tab_title'] as $i => $review) {
         
            $tabData[] = [
                'title' => $data['title'][$i],
                'tab_title' => $data['tab_title'][$i],
                'button_text' => $data['button_text'][$i],
                'button_url' => $data['button_url'][$i],
                'tab_description' => $data['tab_description'][$i],

            ];
        }
        $data['tab_data'] = $tabData;

        unset($data['tab_title']);
        unset($data['title']);
        unset($data['tab_description']);
        unset($data['button_url']);
        unset($data['button_text']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function preparetabstyle7($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $tabData = [];
    
        foreach ($data['tab_title'] as $i => $review) {
            if (!empty($data['tab_image'][$i])) {

                $tabImage = $this->upload($data['tab_image'][$i]);
                if (isset($data['tab_image_old'][$i])) {
                    $this->deleteImage($data['tab_image_old'][$i]);
                }
            } else {
                $tabImage = $data['tab_image_old'][$i];
            }

            $tabData[] = [
                'tab_title' => $data['tab_title'][$i],
                'tab_image_alt_tag' => $data['tab_image_alt_tag'][$i],
                'tab_description' => $data['tab_description'][$i],
                'tab_image' => $tabImage,

            ];
        }
        $data['tab_data'] = $tabData;

        unset($data['tab_title']);
        unset($data['image_alt_tag']);
        unset($data['tab_description']);
        unset($data['tab_image']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


      public function preparetabstyle10($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

         if (!empty($data['banner_bg_image'])) {
            $banner_bg_image_old = $this->upload($data['banner_bg_image']);
            $data['banner_bg_image'] = $banner_bg_image_old;
            if (isset($data['banner_bg_image_old'])) {
                $this->deleteImage($data['banner_bg_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_bg_image_old'];
        }
        $tabData = [];
    
        foreach ($data['tab_title'] as $i => $review) {
            if (!empty($data['tab_image'][$i])) {

                $tabImage = $this->upload($data['tab_image'][$i]);
                if (isset($data['tab_image_old'][$i])) {
                    $this->deleteImage($data['tab_image_old'][$i]);
                }
            } else {
                $tabImage = $data['tab_image_old'][$i];
            }

            $tabData[] = [
                'tab_main_title_' => $data['tab_main_title_'][$i],
                'tab_title' => $data['tab_title'][$i],
                'tab_image' => $tabImage,
                'tab_image_alt_tag' => $data['tab_image_alt_tag'][$i],
                'tab_description' => $data['tab_description'][$i],
                'button_text' => $data['button_text'][$i],
                'button_url' => $data['button_url'][$i],
            ];
        }
        $data['tab_data'] = $tabData;

        unset($data['tab_title']);
        unset($data['image_alt_tag']);
        unset($data['tab_description']);
        unset($data['tab_image']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function prepareservicestyle1($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $serviceData = [];
        foreach ($data['service_title'] as $i => $review) {
            if (!empty($data['service_image_icon'][$i])) {
                $tabImage = $this->upload($data['service_image_icon'][$i]);
            } else {
                $tabImage = $data['service_image_icon_old'][$i];
            }

            $serviceData[] = [
                'service_title' => $data['service_title'][$i],
                'service_image_icon_alt_tag' => $data['service_image_icon_alt_tag'][$i],
                'service_description' => $data['service_description'][$i],
                'step_title' => $data['step_title'][$i],
                'step_text1' => $data['step_text1'][$i],
                'step_text2' => $data['step_text2'][$i],
                'step_text3' => $data['step_text3'][$i],
                'service_image_icon' => $tabImage,
            ];
        }
        $data['service_data'] = $serviceData;

        unset($data['service_title']);
        unset($data['service_image_icon_alt_tag']);
        unset($data['service_description']);
        unset($data['service_image_icon']);
        unset($data['step_title']);
        unset($data['step_text1']);
        unset($data['step_text2']);
        unset($data['step_text3']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareservicestyle3($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $serviceData = [];
        foreach ($data['service_title'] as $i => $review) {
            if (!empty($data['service_image_icon'][$i])) {
                $tabImage = $this->upload($data['service_image_icon'][$i]);
            } else {
                $tabImage = $data['service_image_icon_old'][$i];
            }
            $serviceData[] = [
                'service_title' => $data['service_title'][$i],
                'service_image_icon_alt_tag' => $data['service_image_icon_alt_tag'][$i],
                'service_description' => $data['service_description'][$i],
                'link_text' => $data['link_text'][$i],
                'link_url' => $data['link_url'][$i],
                'service_image_icon' => $tabImage,
            ];
        }

        $data['service_data'] = $serviceData;

        unset($data['service_title']);
        unset($data['service_image_icon_alt_tag']);
        unset($data['service_description']);
        unset($data['service_image_icon']);
        unset($data['link_text']);
        unset($data['link_url']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareservicestyle4($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        if (!empty($data['banner_image'])) {
            $banner_image = $this->upload($data['banner_image']);
            $data['banner_image'] = $banner_image;
            if (isset($data['banner_image_old'])) {
                $this->deleteImage($data['banner_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_image_old'];
        }

        if (!empty($data['icon_image'])) {
            $icon_image = $this->upload($data['icon_image']);
            $data['icon_image'] = $icon_image;
            if (isset($data['icon_image_old'])) {
                $this->deleteImage($data['icon_image_old']);
            }
        } else {
            $data['icon_image'] = $data['icon_image_old'];
        }

        $serviceData = [];
        foreach ($data['step_title'] as $i => $review) {

            $serviceData[] = [
                'step_title' => $data['step_title'][$i],

            ];
        }
        $data['step_service_data'] = $serviceData;
        unset($data['step_title']);

        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareservicestyle5($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        if (!empty($data['banner_image'])) {
            $banner_image = $this->upload($data['banner_image']);
            $data['banner_image'] = $banner_image;
            if (isset($data['banner_image_old'])) {
                $this->deleteImage($data['banner_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_image_old'];
        }

        if (!empty($data['icon_image'])) {
            $icon_image = $this->upload($data['icon_image']);
            $data['icon_image'] = $icon_image;
            if (isset($data['icon_image_old'])) {
                $this->deleteImage($data['icon_image_old']);
            }
        } else {
            $data['icon_image'] = $data['icon_image_old'];
        }
        unset($data['step_title']);

        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareservicestyle6($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $stepData = [];
        foreach ($data['step_title'] as $i => $review) {
            if (!empty($data['step_image'][$i])) {
                $stepImage = $this->upload($data['step_image'][$i]);
            } else {
                $stepImage = $data['step_image_old'][$i];
            }


            $stepData[] = [
                'step_title' => $data['step_title'][$i],
                'step_url' => $data['step_url'][$i],
                'step_image_alt_tag' => $data['step_image_alt_tag'][$i],
                'step_description' => $data['step_description'][$i],
                'step_image' => $stepImage,
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_title']);
        unset($data['step_description']);
        unset($data['step_image']);
        unset($data['step_image_alt_tag']);
        unset($data['step_url']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareservicestyle7($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $stepData = [];


        foreach ($data['step_title'] as $i => $review) {
            if (!empty($data['step_image'][$i])) {
                $stepImage = $this->upload($data['step_image'][$i]);
            } else {
                $stepImage = $data['step_image_old'][$i];
            }

            $stepData[] = [
                'step_image' => $stepImage,
                'step_image_alt_tag' => $data['step_image_alt_tag'][$i],
                'step_title' => $data['step_title'][$i],
                'step_description' => $data['step_description'][$i],
                'step_button_text' => $data['step_button_text'][$i],
                'step_button_url' => $data['step_button_url'][$i],

            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_image']);
        unset($data['step_image_alt_tag']);
        unset($data['step_title']);
        unset($data['step_description']);
        unset($data['step_button_text']);
        unset($data['step_button_url']);


        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareservicestyle8($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $stepData = [];


        foreach ($data['service_title'] as $i => $review) {

            if (!empty($data['service_image_icon'][$i])) {
                $serviceImage = $this->upload($data['service_image_icon'][$i]);
                if (isset($data['step_image_old'])) {
                    $this->deleteImage($data['step_image_old'][$i]);
                }
            } else {
                $serviceImage = $data['step_image_old'][$i];
            }

            if (!empty($data['step_image_icon'][$i])) {
                $StepImageIcon = $this->upload($data['step_image_icon'][$i]);
                if (isset($data['step_image_icon_old'])) {
                    $this->deleteImage($data['step_image_icon_old']);
                }
            } else {
                $StepImageIcon = $data['step_image_icon_old'][$i];
            }

            $stepData[] = [
                'step_image' => $serviceImage,
                'step_image_alt_tag' => $data['service_image_icon_alt_tag'][$i],
                'step_image_icon' => $StepImageIcon,
                'step_image_icon_alt_tag' => $data['step_image_icon_alt_tag'][$i],
                'step_title' => $data['service_title'][$i],
                'step_description' => $data['service_description'][$i],

            ];
        }

        $data['step_data'] = $stepData;
        unset($data['service_image_icon']);
        unset($data['step_image_icon']);
        unset($data['step_image_alt_tag']);
        unset($data['service_image_icon_alt_tag']);
        unset($data['service_title']);
        unset($data['service_description']);


        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareservicestyle9($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $stepData = [];

        foreach ($data['step_title'] as $i => $review) {
            if (!empty($data['step_image_icon'][$i])) {
                $stepImage = $this->upload($data['step_image_icon'][$i]);
            } else {
                $stepImage = $data['step_image_old'][$i];
            }
            $stepData[] = [
                'step_title' => $data['step_title'][$i],
                'step_image_icon_alt_tag' => $data['step_image_icon_alt_tag'][$i],
                'link_text' => $data['link_text'][$i],
                'link_url' => $data['link_url'][$i],
                'step_description' => $data['step_description'][$i],
                'step_image' => $stepImage,
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_title']);
        unset($data['step_description']);
        unset($data['step_image_icon']);
        unset($data['link_text']);
        unset($data['link_url']);
        unset($data['step_image_icon_alt_tag']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }



    public function prepareworkstyle1($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $stepData = [];
        foreach ($data['step_title'] as $i => $review) {

            $stepData[] = [
                'step_title' => $data['step_title'][$i],
                'step_subtitle' => $data['step_subtitle'][$i],
                'step_description' => $data['step_description'][$i],
            ];
        }
        $data['step_data'] = $stepData;
        unset($data['step_title']);
        unset($data['step_subtitle']);
        unset($data['step_description']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function prepareworkstyle2($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $stepData = [];
        foreach ($data['step_title'] as $i => $review) {
            if (!empty($data['step_image_icon'][$i])) {
                $stepImage = $this->upload($data['step_image_icon'][$i]);
            } else {
                $stepImage = $data['step_image_old'][$i];
            }
            $stepData[] = [
                'step_title' => $data['step_title'][$i],
                'step_image_icon_alt_tag' => $data['step_image_icon_alt_tag'][$i],
                'step_description' => $data['step_description'][$i],
                'step_image' => $stepImage,
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_title']);
        unset($data['step_description']);
        unset($data['step_image_icon']);
        unset($data['step_image_icon_alt_tag']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }



    public function prepareworkstyle4($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        if (!empty($data['banner_image'])) {
            $banner_image = $this->upload($data['banner_image']);
            $data['banner_image'] = $banner_image;
            if (isset($data['banner_image_old'])) {
                $this->deleteImage($data['banner_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_image_old'];
        }
        $stepData = [];
        foreach ($data['step_title'] as $i => $review) {
            if (!empty($data['step_image_icon'][$i])) {
                $stepImage = $this->upload($data['step_image_icon'][$i]);
            } else {
                $stepImage = $data['step_image_old'][$i];
            }
            $stepData[] = [
                'step_title' => $data['step_title'][$i],
                'step_subtitle' => $data['step_subtitle'][$i],
                'step_image_icon_alt_tag' => $data['step_image_icon_alt_tag'][$i],
                'step_description' => $data['step_description'][$i],
                'step_image' => $stepImage,
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_title']);
        unset($data['step_subtitle']);
        unset($data['step_description']);
        unset($data['step_image_icon']);
        unset($data['step_image_icon_alt_tag']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareworkstyle5($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        if (!empty($data['image'])) {
            $image = $this->upload($data['image']);
            $data['image'] = $image;
            if (isset($data['image_old'])) {
                $this->deleteImage($data['image_old']);
            }
        } else {
            $data['image'] = $data['image_old'];
        }
        $stepData = [];
        foreach ($data['step_title'] as $i => $review) {

            $stepData[] = [
                'step_title' => $data['step_title'][$i],
                'step_description' => $data['step_description'][$i],
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_title']);
        unset($data['step_description']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function prepareworkstyle6($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $stepData = [];
        foreach ($data['step_title'] as $i => $review) {
            if (!empty($data['step_image'][$i])) {
                $stepImage = $this->upload($data['step_image'][$i]);

                if (isset($data['step_image_old'])) {
                    $this->deleteImage($data['step_image_old'][$i]);
                }
            } else {
                $stepImage = $data['step_image_old'][$i];
            }

            $stepData[] = [
                'step_title' => $data['step_title'][$i],
                'step_description' => $data['step_description'][$i],
                'step_image' => $stepImage,
                'step_image_alt_tag' => $data['step_image_alt_tag'][$i],

            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_title']);
        unset($data['step_description']);
        unset($data['step_image']);
        unset($data['step_image_alt_tag']);

        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareworkstyle7($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);


        $stepData = [];
        foreach ($data['step_title'] as $i => $review) {
            if (!empty($data['step_image'][$i])) {
                $stepImage = $this->upload($data['step_image'][$i]);

                if (isset($data['step_image_old'])) {
                    $this->deleteImage($data['step_image_old'][$i]);
                }
            } else {
                $stepImage = $data['step_image_old'][$i];
            }

            $stepData[] = [
                'step_title' => $data['step_title'][$i],
                'step_description' => $data['step_description'][$i],
                'step_link_text' => $data['step_link_text'][$i],
                'step_link_url' => $data['step_link_url'][$i],
                'step_image' => $stepImage,
                'step_image_alt_tag' => $data['step_image_alt_tag'][$i],

            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_title']);
        unset($data['step_description']);
        unset($data['step_link_text']);
        unset($data['step_link_url']);
        unset($data['step_image']);
        unset($data['step_image_alt_tag']);

        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function prepareworkstyle8($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        if (!empty($data['image1'])) {
            $image1 = $this->upload($data['image1']);
            $data['image1'] = $image1;
            if (isset($data['image1_old'])) {
                $this->deleteImage($data['image1_old']);
            }
        } else {
            $data['image1'] = $data['image1_old'];
        }


        $stepData = [];
        foreach ($data['step_title'] as $i => $review) {

            $stepData[] = [
                'step_title' => $data['step_title'][$i],
                'step_description' => $data['step_description'][$i],

            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_title']);
        unset($data['step_description']);

        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareworkstyle9($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);


        $stepData = [];
        foreach ($data['step_title'] as $i => $review) {
            if (!empty($data['step_image'][$i])) {
                $stepImage = $this->upload($data['step_image'][$i]);

                if (isset($data['step_image_old'])) {
                    $this->deleteImage($data['step_image_old'][$i]);
                }
            } else {
                $stepImage = $data['step_image_old'][$i];
            }

            $stepData[] = [
                'step_title' => $data['step_title'][$i],
                'step_sub_title' => $data['step_sub_title'][$i],
                'step_image' => $stepImage,
                'step_image_alt_tag' => $data['step_image_alt_tag'][$i],

            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_title']);
        unset($data['step_sub_title']);
        unset($data['step_image']);
        unset($data['step_image_alt_tag']);

        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareworkstyle10($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);


        $stepData = [];
        foreach ($data['step_title'] as $i => $review) {
            $stepData[] = [
                'step_title' => $data['step_title'][$i],
                'step_description' => $data['step_description'][$i],

            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_title']);
        unset($data['step_description']);

        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareplanstyle1($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        $stepData = [];
        foreach ($data['plan_title'] as $i => $review) {
            $stepData[] = [
                'plan_title' => $data['plan_title'][$i],
                'plan_type' => $data['plan_type'][$i],
                'plan_button_text' => $data['plan_button_text'][$i],
                'plan_button_url' => $data['plan_button_url'][$i],
                'plan_price' => $data['plan_price'][$i],
                'plan_offer1' => $data['plan_offer1'][$i],
                'plan_offer2' => $data['plan_offer2'][$i],
                'plan_offer3' => $data['plan_offer3'][$i],
                'plan_offer4' => $data['plan_offer4'][$i],
                'plan_offer5' => $data['plan_offer5'][$i],
                'plan_offer6' => $data['plan_offer6'][$i],
                'plan_offer7' => $data['plan_offer7'][$i],
                'plan_offer8' => $data['plan_offer8'][$i],

            ];
        }

        $data['step_data'] = $stepData;
        unset($data['plan_title']);
        unset($data['plan_type']);
        unset($data['plan_button_text']);
        unset($data['plan_button_url']);
        unset($data['plan_price']);
        unset($data['plan_offer1']);
        unset($data['plan_offer2']);
        unset($data['plan_offer3']);
        unset($data['plan_offer4']);
        unset($data['plan_offer5']);
        unset($data['plan_offer6']);
        unset($data['plan_offer7']);
        unset($data['plan_offer8']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareplanstyle2($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        $stepData = [];
        foreach ($data['plan_title'] as $i => $review) {
            $stepData[] = [
                'plan_title' => $data['plan_title'][$i],
                'plan_type' => $data['plan_type'][$i],
                'plan_button_text' => $data['plan_button_text'][$i],
                'plan_button_url' => $data['plan_button_url'][$i],
                'plan_price' => $data['plan_price'][$i],
                'plan_description' => $data['plan_description'][$i],
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['plan_title']);
        unset($data['plan_type']);
        unset($data['plan_button_text']);
        unset($data['plan_button_url']);
        unset($data['plan_price']);
        unset($data['plan_description']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareplanstyle4($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        $stepData = [];
        foreach ($data['plan_title'] as $i => $review) {
            if (!empty($data['step_image_icon'][$i])) {
                $stepImage = $this->upload($data['step_image_icon'][$i]);
                if (isset($data['step_image_old'])) {
                    $this->deleteImage($data['step_image_old'][$i]);
                }
            } else {
                $stepImage = $data['step_image_old'][$i];
            }
            $stepData[] = [
                'plan_title' => $data['plan_title'][$i],
                'plan_sub_title' => $data['plan_sub_title'][$i],
                'plan_button_text' => $data['plan_button_text'][$i],
                'plan_button_url' => $data['plan_button_url'][$i],
                'step_image' => $stepImage,
                'step_image_icon_alt_tag' => $data['step_image_icon_alt_tag'][$i],
                'plan_offer1' => $data['plan_offer1'][$i],
                'plan_offer2' => $data['plan_offer2'][$i],
                'plan_offer3' => $data['plan_offer3'][$i],
                'plan_offer4' => $data['plan_offer4'][$i],
                'plan_offer5' => $data['plan_offer5'][$i],
                'plan_offer6' => $data['plan_offer6'][$i],
                'plan_offer7' => $data['plan_offer7'][$i],
                'plan_offer8' => $data['plan_offer8'][$i],
                'plan_description' => $data['plan_description'][$i],
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['plan_title']);
        unset($data['plan_sub_title']);
        unset($data['plan_button_text']);
        unset($data['plan_button_url']);
        unset($data['step_image_icon_alt_tag']);
        unset($data['plan_description']);
        unset($data['plan_offer1']);
        unset($data['plan_offer2']);
        unset($data['plan_offer3']);
        unset($data['plan_offer4']);
        unset($data['plan_offer5']);
        unset($data['plan_offer6']);
        unset($data['plan_offer7']);
        unset($data['plan_offer8']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareplanstyle5($data)
    {
        // Extract HTML content separately
        $datanew['form_html'] = $data['html_content'] ?? null;
        unset($data['html_content']);

        $stepData = [];

        // Loop through each plan by index
        foreach ($data['plan_title'] as $i => $title) {
            // Upload image if new one is provided
            if (!empty($data['step_image_icon'][$i])) {
                $stepImage = $this->upload($data['step_image_icon'][$i]);

                // Delete old image if it exists
                if (!empty($data['step_image_old'][$i])) {
                    $this->deleteImage($data['step_image_old'][$i]);
                }
            } else {
                $stepImage = $data['step_image_old'][$i] ?? null;
            }

            // Build each step (plan) data
            $stepData[] = [
                'plan_title' => $data['plan_title'][$i],
                'plan_button_text' => $data['plan_button_text'][$i] ?? '',
                'plan_button_url' => $data['plan_button_url'][$i] ?? '',
                'step_image' => $stepImage,
                'step_image_icon_alt_tag' => $data['step_image_icon_alt_tag'][$i] ?? '',
                'plan_type' => $data['plan_type'][$i] ?? '',
                'plan_price' => $data['plan_price'][$i] ?? '',
                'plan_offer1' => $data['plan_offer1'][$i] ?? '',
                'plan_offer2' => $data['plan_offer2'][$i] ?? '',
                'plan_offer3' => $data['plan_offer3'][$i] ?? '',
                'plan_offer4' => $data['plan_offer4'][$i] ?? '',
                'plan_offer5' => $data['plan_offer5'][$i] ?? '',
                'plan_offer6' => $data['plan_offer6'][$i] ?? '',
                'plan_offer7' => $data['plan_offer7'][$i] ?? '',
                'plan_offer8' => $data['plan_offer8'][$i] ?? '',
                'plan_description' => $data['plan_description'][$i] ?? '',
            ];
        }

        // Set step_data and clean up other fields
        $data['step_data'] = $stepData;

        unset(
            $data['plan_title'],
            $data['plan_button_text'],
            $data['plan_button_url'],
            $data['step_image_icon'],
            $data['step_image_old'],
            $data['step_image_icon_alt_tag'],
            $data['plan_type'],
            $data['plan_price'],
            $data['plan_offer1'],
            $data['plan_offer2'],
            $data['plan_offer3'],
            $data['plan_offer4'],
            $data['plan_offer5'],
            $data['plan_offer6'],
            $data['plan_offer7'],
            $data['plan_offer8'],
            $data['plan_description']
        );

        // Final store structure
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }
    public function prepareplanstyle6($data)
    {
        // Extract HTML content separately
        $datanew['form_html'] = $data['html_content'] ?? null;
        unset($data['html_content']);

        $stepData = [];

        // Loop through each plan by index
        foreach ($data['plan_title'] as $i => $title) {

            // Build each step (plan) data
            $stepData[] = [
                'plan_title' => $data['plan_title'][$i],
                'plan_button_text' => $data['plan_button_text'][$i] ?? '',
                'plan_button_url' => $data['plan_button_url'][$i] ?? '',
                'bottom_title' => $data['bottom_title'][$i] ?? '',
                'plan_type' => $data['plan_type'][$i] ?? '',
                'plan_price' => $data['plan_price'][$i] ?? '',
                'plan_offer1' => $data['plan_offer1'][$i] ?? '',
                'plan_offer2' => $data['plan_offer2'][$i] ?? '',
                'plan_offer3' => $data['plan_offer3'][$i] ?? '',
                'plan_offer4' => $data['plan_offer4'][$i] ?? '',
                'plan_offer5' => $data['plan_offer5'][$i] ?? '',
                'plan_offer6' => $data['plan_offer6'][$i] ?? '',
                'plan_offer7' => $data['plan_offer7'][$i] ?? '',
                'plan_offer8' => $data['plan_offer8'][$i] ?? '',
                'plan_description' => $data['plan_description'][$i] ?? '',
            ];
        }

        // Set step_data and clean up other fields
        $data['step_data'] = $stepData;

        unset(
            $data['plan_title'],
            $data['bottom_title'],
            $data['plan_button_text'],
            $data['plan_button_url'],
            $data['plan_type'],
            $data['plan_price'],
            $data['plan_offer1'],
            $data['plan_offer2'],
            $data['plan_offer3'],
            $data['plan_offer4'],
            $data['plan_offer5'],
            $data['plan_offer6'],
            $data['plan_offer7'],
            $data['plan_offer8'],
            $data['plan_description']
        );

        // Final store structure
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareplanstyle7($data)
    {
        // Extract HTML content separately
        $datanew['form_html'] = $data['html_content'] ?? null;
        unset($data['html_content']);

        $stepData = [];

        // Loop through each plan by index
        foreach ($data['plan_title'] as $i => $title) {
            // Upload image if new one is provided
            if (!empty($data['step_image_icon'][$i])) {
                $stepImageIcon = $this->upload($data['step_image_icon'][$i]);

                // Delete old image if it exists
                if (!empty($data['step_image_icon_old'][$i])) {
                    $this->deleteImage($data['step_image_icon_old'][$i]);
                }
            } else {
                $stepImageIcon = $data['step_image_icon_old'][$i] ?? null;
            }

            if (!empty($data['step_image'][$i])) {
                $stepImage = $this->upload($data['step_image'][$i]);

                // Delete old image if it exists
                if (!empty($data['step_image_old'][$i])) {
                    $this->deleteImage($data['step_image_old'][$i]);
                }
            } else {
                $stepImage = $data['step_image_old'][$i] ?? null;
            }

            // Build each step (plan) data
            $stepData[] = [
                'plan_title' => $data['plan_title'][$i],
                'plan_button_text' => $data['plan_button_text'][$i] ?? '',
                'plan_button_url' => $data['plan_button_url'][$i] ?? '',
                'step_image' => $stepImage,
                'step_image_alt_tag' => $data['step_image_alt_tag'][$i] ?? '',
                'step_image_icon' => $stepImageIcon,
                'step_image_icon_alt_tag' => $data['step_image_icon_alt_tag'][$i] ?? '',
                'plan_type' => $data['plan_type'][$i] ?? '',
                'plan_price' => $data['plan_price'][$i] ?? '',
                'plan_offer1' => $data['plan_offer1'][$i] ?? '',
                'plan_offer2' => $data['plan_offer2'][$i] ?? '',
                'plan_offer3' => $data['plan_offer3'][$i] ?? '',
                'plan_offer4' => $data['plan_offer4'][$i] ?? '',
                'plan_offer5' => $data['plan_offer5'][$i] ?? '',
                'plan_description' => $data['plan_description'][$i] ?? '',
            ];
        }

        // Set step_data and clean up other fields
        $data['step_data'] = $stepData;

        unset(
            $data['plan_title'],
            $data['plan_button_text'],
            $data['plan_button_url'],
            $data['step_image_icon'],
            $data['step_image_old'],
            $data['step_image_icon_alt_tag'],
            $data['step_image_alt_tag'],
            $data['step_image_icon_old'],
            $data['step_image'],
            $data['step_image_icon_alt_tag'],
            $data['plan_type'],
            $data['plan_price'],
            $data['plan_offer1'],
            $data['plan_offer2'],
            $data['plan_offer3'],
            $data['plan_offer4'],
            $data['plan_offer5'],
            $data['plan_description']
        );

        // Final store structure
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareplanstyle8($data)
    {
        // Extract HTML content separately
        $datanew['form_html'] = $data['html_content'] ?? null;
        unset($data['html_content']);

        $stepData = [];

        // Loop through each plan by index
        foreach ($data['plan_title'] as $i => $title) {
            // Upload image if new one is provided


            if (!empty($data['step_image'][$i])) {
                $stepImage = $this->upload($data['step_image'][$i]);

                // Delete old image if it exists
                if (!empty($data['step_image_old'][$i])) {
                    $this->deleteImage($data['step_image_old'][$i]);
                }
            } else {
                $stepImage = $data['step_image_old'][$i] ?? null;
            }

            // Build each step (plan) data
            $stepData[] = [
                'plan_title' => $data['plan_title'][$i],
                'plan_button_text' => $data['plan_button_text'][$i] ?? '',
                'plan_button_url' => $data['plan_button_url'][$i] ?? '',
                'step_image' => $stepImage,
                'step_image_alt_tag' => $data['step_image_alt_tag'][$i] ?? '',
                'plan_type' => $data['plan_type'][$i] ?? '',
                'plan_price' => $data['plan_price'][$i] ?? '',
                'plan_offer1' => $data['plan_offer1'][$i] ?? '',
                'plan_offer2' => $data['plan_offer2'][$i] ?? '',
                'plan_offer3' => $data['plan_offer3'][$i] ?? '',
                'plan_offer4' => $data['plan_offer4'][$i] ?? '',
                'plan_description' => $data['plan_description'][$i] ?? '',
            ];
        }

        // Set step_data and clean up other fields
        $data['step_data'] = $stepData;

        unset(
            $data['plan_title'],
            $data['plan_button_text'],
            $data['plan_button_url'],
            $data['step_image'],
            $data['step_image_old'],
            $data['step_image_alt_tag'],
            $data['plan_type'],
            $data['plan_price'],
            $data['plan_offer1'],
            $data['plan_offer2'],
            $data['plan_offer3'],
            $data['plan_offer4'],
            $data['plan_description']
        );

        // Final store structure
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareplanstyle9($data)
    {
        // Extract HTML content separately
        $datanew['form_html'] = $data['html_content'] ?? null;
        unset($data['html_content']);

        $stepData = [];

        // Loop through each plan by index
        foreach ($data['plan_title'] as $i => $title) {
            // Upload image if new one is provided


            if (!empty($data['step_image'][$i])) {
                $stepImage = $this->upload($data['step_image'][$i]);

                // Delete old image if it exists
                if (!empty($data['step_image_old'][$i])) {
                    $this->deleteImage($data['step_image_old'][$i]);
                }
            } else {
                $stepImage = $data['step_image_old'][$i] ?? null;
            }

            // Build each step (plan) data
            $stepData[] = [
                'plan_title' => $data['plan_title'][$i],
                'offer_title' => $data['offer_title'][$i],
                'sub_title' => $data['sub_title'][$i],
                'plan_button_text' => $data['plan_button_text'][$i] ?? '',
                'plan_button_url' => $data['plan_button_url'][$i] ?? '',
                'step_image' => $stepImage,
                'step_image_alt_tag' => $data['step_image_alt_tag'][$i] ?? '',
                'plan_type' => $data['plan_type'][$i] ?? '',
                'plan_price' => $data['plan_price'][$i] ?? '',
                'plan_offer1' => $data['plan_offer1'][$i] ?? '',
                'plan_offer2' => $data['plan_offer2'][$i] ?? '',
                'plan_offer3' => $data['plan_offer3'][$i] ?? '',
                'plan_offer4' => $data['plan_offer4'][$i] ?? '',
                'plan_description' => $data['plan_description'][$i] ?? '',
            ];
        }

        // Set step_data and clean up other fields
        $data['step_data'] = $stepData;

        unset(
            $data['plan_title'],
            $data['offer_title'],
            $data['sub_title'],
            $data['plan_button_text'],
            $data['plan_button_url'],
            $data['step_image'],
            $data['step_image_old'],
            $data['step_image_alt_tag'],
            $data['plan_type'],
            $data['plan_price'],
            $data['plan_offer1'],
            $data['plan_offer2'],
            $data['plan_offer3'],
            $data['plan_offer4'],
            $data['plan_description']
        );

        // Final store structure
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function prepareplanstyle10($data)
    {
        // Extract HTML content separately
        $datanew['form_html'] = $data['html_content'] ?? null;
        unset($data['html_content']);

        $stepData = [];

        // Loop through each plan by index
        foreach ($data['plan_title'] as $i => $title) {
            // Upload image if new one is provided

            // Build each step (plan) data
            $stepData[] = [
                'plan_title' => $data['plan_title'][$i],
                'sub_title' => $data['sub_title'][$i],
                'plan_button_text' => $data['plan_button_text'][$i] ?? '',
                'plan_button_url' => $data['plan_button_url'][$i] ?? '',
                'plan_type' => $data['plan_type'][$i] ?? '',
                'plan_price' => $data['plan_price'][$i] ?? '',
                'plan_offer1' => $data['plan_offer1'][$i] ?? '',
                'plan_offer2' => $data['plan_offer2'][$i] ?? '',
                'plan_offer3' => $data['plan_offer3'][$i] ?? '',
                'plan_offer4' => $data['plan_offer4'][$i] ?? '',
            ];
        }

        // Set step_data and clean up other fields
        $data['step_data'] = $stepData;

        unset(
            $data['plan_title'],
            $data['sub_title'],
            $data['plan_button_text'],
            $data['plan_button_url'],
            $data['plan_type'],
            $data['plan_price'],
            $data['plan_offer1'],
            $data['plan_offer2'],
            $data['plan_offer3'],
            $data['plan_offer4'],
        );

        // Final store structure
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }
    public function preparefaqstyle1($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        if (!empty($data['banner_image'])) {
            $banner_image = $this->upload($data['banner_image']);
            $data['banner_image'] = $banner_image;
            if (isset($data['banner_image_old'])) {
                $this->deleteImage($data['banner_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_image_old'];
        }
        $faqSteps = [];

        foreach ($data['faq_question'] as $i => $review) {
            $faqSteps[] = [
                'faq_question' => $data['faq_question'][$i],
                'faq_answer' => $data['faq_answer'][$i],
            ];
        }
        $data['step_data'] = $faqSteps;
        unset($data['faq_question']);
        unset($data['faq_answer']);

        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function preparefaqstyle2($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $faqSteps = [];
        foreach ($data['faq_question'] as $i => $review) {
            $faqSteps[] = [
                'faq_question' => $data['faq_question'][$i],
                'faq_answer' => $data['faq_answer'][$i],
            ];
        }
        $data['step_data'] = $faqSteps;
        unset($data['faq_question']);
        unset($data['faq_answer']);

        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function preparefaqstyle3($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        if (!empty($data['banner_image'])) {
            $banner_image = $this->upload($data['banner_image']);
            $data['banner_image'] = $banner_image;
            if (isset($data['banner_image_old'])) {
                $this->deleteImage($data['banner_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_image_old'];
        }


        if (!empty($data['image1'])) {
            $banner_image = $this->upload($data['image1']);
            $data['image1'] = $banner_image;
            if (isset($data['image1_old'])) {
                $this->deleteImage($data['image1_old']);
            }
        } else {
            $data['image1'] = $data['image1_old'];
        }

        if (!empty($data['image2'])) {
            $banner_image = $this->upload($data['image2']);
            $data['image2'] = $banner_image;
            if (isset($data['image2_old'])) {
                $this->deleteImage($data['image2_old']);
            }
        } else {
            $data['image2'] = $data['image2_old'];
        }

        if (!empty($data['image3'])) {
            $banner_image = $this->upload($data['image3']);
            $data['image3'] = $banner_image;
            if (isset($data['image3_old'])) {
                $this->deleteImage($data['image3_old']);
            }
        } else {
            $data['image3'] = $data['image3_old'];
        }


        $faqSteps = [];
        foreach ($data['faq_question'] as $i => $review) {
            $faqSteps[] = [
                'faq_question' => $data['faq_question'][$i],
                'faq_answer' => $data['faq_answer'][$i],
            ];
        }
        $data['step_data'] = $faqSteps;
        unset($data['faq_question']);
        unset($data['faq_answer']);

        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function preparefaqstyle4($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        if (!empty($data['banner_image'])) {
            $banner_image = $this->upload($data['banner_image']);
            $data['banner_image'] = $banner_image;
            if (isset($data['banner_image_old'])) {
                $this->deleteImage($data['banner_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_image_old'];
        }

        $faqSteps = [];
        foreach ($data['faq_question'] as $i => $review) {
            $faqSteps[] = [
                'faq_question' => $data['faq_question'][$i],
                'faq_answer' => $data['faq_answer'][$i],
            ];
        }
        $data['step_data'] = $faqSteps;
        unset($data['faq_question']);
        unset($data['faq_answer']);

        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];


        return $storeData;
    }

    public function preparefaqstyle6($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $stepData = [];

        foreach ($data['step_title'] as $i => $review) {
            if (!empty($data['step_image'][$i])) {
                $stepImage = $this->upload($data['step_image'][$i]);

                if (isset($data['step_image_old'])) {
                    $this->deleteImage($data['step_image_old'][$i]);
                }
            } else {
                $stepImage = $data['step_image_old'][$i];
            }

            $stepData[] = [
                'step_title' => $data['step_title'][$i],
                'step_description' => $data['step_description'][$i],
                'step_image' => $stepImage,
                'step_image_alt_tag' => $data['step_image_alt_tag'][$i],

            ];
        }
        $data['step_data'] = $stepData;
        unset($data['step_title']);
        unset($data['step_description']);
        unset($data['step_image']);
        unset($data['step_image_alt_tag']);

        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function preparefaqstyle7($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        if (!empty($data['image'])) {
            $image = $this->upload($data['image']);
            $data['image'] = $image;
            if (isset($data['image_old'])) {
                $this->deleteImage($data['image_old']);
            }
        } else {
            $data['image'] = $data['image_old'];
        }

        $faqSteps = [];
        foreach ($data['step_title'] as $i => $review) {
            $faqSteps[] = [
                'step_title' => $data['step_title'][$i],
                'step_description' => $data['step_description'][$i],
            ];
        }
        $data['step_data'] = $faqSteps;
        unset($data['step_title']);
        unset($data['step_description']);

        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];


        return $storeData;
    }

    public function preparefaqstyle9($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        if (!empty($data['image1'])) {
            $image1 = $this->upload($data['image1']);
            $data['image1'] = $image1;
            if (isset($data['image1_old'])) {
                $this->deleteImage($data['image1_old']);
            }
        } else {
            $data['image1'] = $data['image1_old'];
        }

        if (!empty($data['image2'])) {
            $image1 = $this->upload($data['image2']);
            $data['image2'] = $image1;
            if (isset($data['image2_old'])) {
                $this->deleteImage($data['image2_old']);
            }
        } else {
            $data['image2'] = $data['image2_old'];
        }

        $faqSteps = [];
        foreach ($data['step_title'] as $i => $review) {
            $faqSteps[] = [
                'step_title' => $data['step_title'][$i],
                'step_description' => $data['step_description'][$i],
            ];
        }
        $data['step_data'] = $faqSteps;
        unset($data['step_title']);
        unset($data['step_description']);

        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];


        return $storeData;
    }

    public function preparefaqstyle10($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        $faqSteps = [];
        foreach ($data['step_title'] as $i => $review) {
            $faqSteps[] = [
                'step_title' => $data['step_title'][$i],
                'step_description' => $data['step_description'][$i],
            ];
        }
        $data['step_data'] = $faqSteps;
        unset($data['step_title']);
        unset($data['step_description']);

        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];


        return $storeData;
    }
    public function prepareFeaturestyle1($data)
    {
        if (!empty($data['image'])) {
            $image = $this->upload($data['image']);
            $data['image'] = $image;
        } else {
            $data['image'] = $data['image_old'];
            unset($data['image_old']);
        }

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $stepData = [];
        foreach ($data['step_title'] as $i => $review) {
            if (!empty($data['step_image_icon'][$i])) {
                $stepImage = $this->upload($data['step_image_icon'][$i]);
            } else {
                $stepImage = $data['step_image_old'][$i];
            }
            $stepData[] = [
                'step_title' => $data['step_title'][$i],
                'step_image_icon_alt_tag' => $data['step_image_icon_alt_tag'][$i],
                'step_description' => $data['step_description'][$i],
                'step_image' => $stepImage,
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_title']);
        unset($data['step_description']);
        unset($data['step_image_icon']);
        unset($data['step_image_icon_alt_tag']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function prepareFeaturestyle3($data)
    {
        if (!empty($data['banner_bg_image'])) {
            $image = $this->upload($data['banner_bg_image']);
            $data['banner_bg_image'] = $image;
        } else {
            $data['banner_bg_image'] = $data['banner_bg_image_old'];
        }

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $stepData = [];
        foreach ($data['step_title'] as $i => $review) {
            $stepData[] = [
                'step_title' => $data['step_title'][$i],
                'step_description' => $data['step_description'][$i],
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_title']);
        unset($data['step_description']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareFeaturestyle4($data)
    {
        if (!empty($data['image'])) {
            $image = $this->upload($data['image']);
            $data['image'] = $image;
        } else {
            $data['image'] = $data['image_old'];
        }

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $stepData = [];
        foreach ($data['step_title'] as $i => $review) {
            $stepData[] = [
                'step_title' => $data['step_title'][$i],
                'step_subtitle' => $data['step_subtitle'][$i],
                'step_description' => $data['step_description'][$i],
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_title']);
        unset($data['step_description']);
        unset($data['step_subtitle']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function prepareFeaturestyle5($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $stepData = [];

        foreach ($data['step_title'] as $i => $review) {
            if (!empty($data['step_image_icon'][$i])) {
                $stepImage = $this->upload($data['step_image_icon'][$i]);
            } else {
                $stepImage = $data['step_image_old'][$i];
            }
            $stepData[] = [
                'step_title' => $data['step_title'][$i],
                'step_image_icon_alt_tag' => $data['step_image_icon_alt_tag'][$i],
                'step_description' => $data['step_description'][$i],
                'step_image' => $stepImage,
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_title']);
        unset($data['step_description']);
        unset($data['step_image_icon']);
        unset($data['step_image_icon_alt_tag']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareFeaturestyle9($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        if (!empty($data['banner_image'])) {
            $banner_image = $this->upload($data['banner_image']);
            $data['banner_image'] = $banner_image;
            if (isset($data['banner_image_old'])) {
                $this->deleteImage($data['banner_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_image_old'];
        }
        $stepData = [];

        foreach ($data['step_title'] as $i => $review) {
            if (!empty($data['step_image'][$i])) {
                $stepImage = $this->upload($data['step_image'][$i]);
            } else {
                $stepImage = $data['step_image_old'][$i];
            }
            $stepData[] = [
                'step_title' => $data['step_title'][$i],
                'image_icon_alt_tag' => $data['image_icon_alt_tag'][$i],
                'step_description' => $data['step_description'][$i],
                'step_image' => $stepImage,
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_title']);
        unset($data['step_description']);
        unset($data['step_image_icon']);
        unset($data['image_icon_alt_tag']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }



    public function prepareFeaturestyle11($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        if (!empty($data['banner_image'])) {
            $banner_image = $this->upload($data['banner_image']);
            $data['banner_image'] = $banner_image;
            if (isset($data['banner_image_old'])) {
                $this->deleteImage($data['banner_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_image_old'];
        }
        $stepData = [];
        foreach ($data['step_title'] as $i => $review) {
            $stepData[] = [
                'step_title' => $data['step_title'][$i],
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_title']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareFeaturestyle12($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        if (!empty($data['banner_image'])) {
            $banner_image = $this->upload($data['banner_image']);
            $data['banner_image'] = $banner_image;
            if (isset($data['banner_image_old'])) {
                $this->deleteImage($data['banner_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_image_old'];
        }

        if (!empty($data['image1'])) {
            $banner_image = $this->upload($data['image1']);
            $data['image1'] = $banner_image;
            if (isset($data['image1_old'])) {
                $this->deleteImage($data['image1_old']);
            }
        } else {
            $data['image1'] = $data['image1_old'];
        }

        if (!empty($data['image2'])) {
            $banner_image = $this->upload($data['image2']);
            $data['image2'] = $banner_image;
            if (isset($data['image2_old'])) {
                $this->deleteImage($data['image2_old']);
            }
        } else {
            $data['image2'] = $data['image2_old'];
        }
        $stepData = [];
        foreach ($data['step_title'] as $i => $review) {
            $stepData[] = [
                'step_title' => $data['step_title'][$i],
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_title']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareFeaturestyle13($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        if (!empty($data['banner_image'])) {
            $banner_image = $this->upload($data['banner_image']);
            $data['banner_image'] = $banner_image;
            if (isset($data['banner_image_old'])) {
                $this->deleteImage($data['banner_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_image_old'];
        }
        $stepData = [];
        foreach ($data['step_title'] as $i => $review) {
            $stepData[] = [
                'step_title' => $data['step_title'][$i],
                'step_sub_title' => $data['step_sub_title'][$i],
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_title']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function prepareFeaturestyle14($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        if (!empty($data['banner_image'])) {
            $banner_image = $this->upload($data['banner_image']);
            $data['banner_image'] = $banner_image;
            if (isset($data['banner_image_old'])) {
                $this->deleteImage($data['banner_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_image_old'];
        }
        if (!empty($data['image1'])) {
            $banner_image = $this->upload($data['image1']);
            $data['image1'] = $banner_image;
            if (isset($data['image1_old'])) {
                $this->deleteImage($data['image1_old']);
            }
        } else {
            $data['image1'] = $data['image1_old'];
        }

        if (!empty($data['image2'])) {
            $banner_image = $this->upload($data['image2']);
            $data['image2'] = $banner_image;
            if (isset($data['image2_old'])) {
                $this->deleteImage($data['image2_old']);
            }
        } else {
            $data['image2'] = $data['image2_old'];
        }

        if (!empty($data['image3'])) {
            $banner_image = $this->upload($data['image3']);
            $data['image3'] = $banner_image;
            if (isset($data['image3_old'])) {
                $this->deleteImage($data['image3_old']);
            }
        } else {
            $data['image3'] = $data['image3_old'];
        }

        if (!empty($data['image4'])) {
            $banner_image = $this->upload($data['image4']);
            $data['image4'] = $banner_image;
            if (isset($data['image4_old'])) {
                $this->deleteImage($data['image4_old']);
            }
        } else {
            $data['image4'] = $data['image4_old'];
        }

        if (!empty($data['image5'])) {
            $banner_image = $this->upload($data['image5']);
            $data['image5'] = $banner_image;
            if (isset($data['image5_old'])) {
                $this->deleteImage($data['image5_old']);
            }
        } else {
            $data['image5'] = $data['image5_old'];
        }

        $stepData = [];
        foreach ($data['step_image_url'] as $i => $review) {

            if (!empty($data['step_image'][$i])) {
                $stepImage = $this->upload($data['step_image'][$i]);
            } else {
                $stepImage = $data['step_image_old'][$i];
            }
            $stepData[] = [
                'step_image' => $stepImage,
                'step_image_alt_tag' => $data['step_image_alt_tag'][$i],
                'step_image_url' => $data['step_image_url'][$i],
            ];
        }

        $data['step_data'] = $stepData;

        unset($data['step_image_alt_tag']);
        unset($data['step_image_url']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }




    public function prepareFeaturestyle15($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        if (!empty($data['banner_image'])) {
            $banner_image = $this->upload($data['banner_image']);
            $data['banner_image'] = $banner_image;
            if (isset($data['banner_image_old'])) {
                $this->deleteImage($data['banner_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_image_old'];
        }
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function prepareFeaturestyle16($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);


        if (!empty($data['image1'])) {
            $banner_image = $this->upload($data['image1']);
            $data['image1'] = $banner_image;
            if (isset($data['image1_old'])) {
                $this->deleteImage($data['image1_old']);
            }
        } else {
            $data['image1'] = $data['image1_old'];
        }

        if (!empty($data['image2'])) {
            $banner_image = $this->upload($data['image2']);
            $data['image2'] = $banner_image;
            if (isset($data['image2_old'])) {
                $this->deleteImage($data['image2_old']);
            }
        } else {
            $data['image2'] = $data['image2_old'];
        }


        $stepData = [];
        foreach ($data['step_title'] as $i => $review) {

            if (!empty($data['step_image'][$i])) {
                $stepImage = $this->upload($data['step_image'][$i]);
            } else {
                $stepImage = $data['step_image_old'][$i];
            }
            $stepData[] = [
                'step_image' => $stepImage,
                'step_image_alt_tag' => $data['step_image_alt_tag'][$i],
                'step_title' => $data['step_title'][$i],
                'step_description' => $data['step_description'][$i],
            ];
        }

        $data['step_data'] = $stepData;

        unset($data['step_image_alt_tag']);
        unset($data['step_title']);
        unset($data['step_description']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareFeaturestyle17($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        $stepData = [];
        foreach ($data['step_image_alt_tag'] as $i => $review) {

            if (!empty($data['step_image'][$i])) {
                $stepImage = $this->upload($data['step_image'][$i]);
            } else {
                $stepImage = $data['step_image_old'][$i];
            }
            $stepData[] = [
                'step_image' => $stepImage,
                'step_image_alt_tag' => $data['step_image_alt_tag'][$i],
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_image_alt_tag']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareFeaturestyle18($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);


        if (!empty($data['image1'])) {
            $banner_image = $this->upload($data['image1']);
            $data['image1'] = $banner_image;
            if (isset($data['image1_old'])) {
                $this->deleteImage($data['image1_old']);
            }
        } else {
            $data['image1'] = $data['image1_old'];
        }



        if (!empty($data['image2'])) {
            $banner_image = $this->upload($data['image2']);
            $data['image2'] = $banner_image;
            if (isset($data['image2_old'])) {
                $this->deleteImage($data['image2_old']);
            }
        } else {
            $data['image2'] = $data['image2_old'];
        }

        if (!empty($data['image3'])) {
            $banner_image = $this->upload($data['image3']);
            $data['image3'] = $banner_image;
            if (isset($data['image3_old'])) {
                $this->deleteImage($data['image3_old']);
            }
        } else {
            $data['image3'] = $data['image3_old'];
        }

        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareFeaturestyle19($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);


        if (!empty($data['image1'])) {
            $banner_image = $this->upload($data['image1']);
            $data['image1'] = $banner_image;
            if (isset($data['image1_old'])) {
                $this->deleteImage($data['image1_old']);
            }
        } else {
            $data['image1'] = $data['image1_old'];
        }



        if (!empty($data['image2'])) {
            $banner_image = $this->upload($data['image2']);
            $data['image2'] = $banner_image;
            if (isset($data['image2_old'])) {
                $this->deleteImage($data['image2_old']);
            }
        } else {
            $data['image2'] = $data['image2_old'];
        }


        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareFeaturestyle20($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);


        if (!empty($data['image1'])) {
            $banner_image = $this->upload($data['image1']);
            $data['image1'] = $banner_image;
            if (isset($data['image1_old'])) {
                $this->deleteImage($data['image1_old']);
            }
        } else {
            $data['image1'] = $data['image1_old'];
        }



        if (!empty($data['image2'])) {
            $banner_image = $this->upload($data['image2']);
            $data['image2'] = $banner_image;
            if (isset($data['image2_old'])) {
                $this->deleteImage($data['image2_old']);
            }
        } else {
            $data['image2'] = $data['image2_old'];
        }

        if (!empty($data['image3'])) {
            $banner_image = $this->upload($data['image3']);
            $data['image3'] = $banner_image;
            if (isset($data['image3_old'])) {
                $this->deleteImage($data['image3_old']);
            }
        } else {
            $data['image3'] = $data['image3_old'];
        }


        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function prepareFeaturestyle21($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $stepData = [];

        foreach ($data['name'] as $i => $review) {
            if (!empty($data['step_image'][$i])) {
                $stepImage = $this->upload($data['step_image'][$i]);
            } else {
                $stepImage = $data['step_image_old'][$i];
            }

            $stepData[] = [
                'step_image' => $stepImage,
                'step_image_alt_tag' => $data['step_image_alt_tag'][$i],
                'name' => $data['name'][$i],
                'designation' => $data['designation'][$i],

            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_image']);
        unset($data['step_image_alt_tag']);
        unset($data['name']);
        unset($data['designation']);


        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }



    public function prepareFeaturestyle22($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        if (!empty($data['banner_image'])) {
            $banner_image = $this->upload($data['banner_image']);
            $data['banner_image'] = $banner_image;
            if (isset($data['banner_image_old'])) {
                $this->deleteImage($data['banner_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_image_old'];
        }


        if (!empty($data['image1'])) {
            $image1 = $this->upload($data['image1']);
            $data['image1'] = $image1;
            if (isset($data['image1_old'])) {
                $this->deleteImage($data['image1_old']);
            }
        } else {
            $data['image1'] = $data['image1_old'];
        }

        $stepData = [];
        foreach ($data['step_title'] as $i => $review) {

            $stepData[] = [
                'step_title' => $data['step_title'][$i],
                'step_sub_title' => $data['step_sub_title'][$i],

            ];
        }
        $data['step_data'] = $stepData;
        unset($data['step_title']);
        unset($data['step_sub_title']);

        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareFeaturestyle23($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        if (!empty($data['image1'])) {
            $banner_image = $this->upload($data['image1']);
            $data['image1'] = $banner_image;
            if (isset($data['image1_old'])) {
                $this->deleteImage($data['image1_old']);
            }
        } else {
            $data['image1'] = $data['image1_old'];
        }

        if (!empty($data['image2'])) {
            $banner_image = $this->upload($data['image2']);
            $data['image2'] = $banner_image;
            if (isset($data['image2_old'])) {
                $this->deleteImage($data['image2_old']);
            }
        } else {
            $data['image2'] = $data['image2_old'];
        }

        if (!empty($data['image3'])) {
            $banner_image = $this->upload($data['image3']);
            $data['image3'] = $banner_image;
            if (isset($data['image3_old'])) {
                $this->deleteImage($data['image3_old']);
            }
        } else {
            $data['image3'] = $data['image3_old'];
        }


        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareFeaturestyle24($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $stepData = [];

        if (!empty($data['image1'])) {
            $banner_image = $this->upload($data['image1']);
            $data['image1'] = $banner_image;
            if (isset($data['image1_old'])) {
                $this->deleteImage($data['image1_old']);
            }
        } else {
            $data['image1'] = $data['image1_old'];
        }

        if (!empty($data['image2'])) {
            $banner_image = $this->upload($data['image2']);
            $data['image2'] = $banner_image;
            if (isset($data['image2_old'])) {
                $this->deleteImage($data['image2_old']);
            }
        } else {
            $data['image2'] = $data['image2_old'];
        }

        foreach ($data['step_title'] as $i => $review) {
            if (!empty($data['step_image'][$i])) {
                $stepImage = $this->upload($data['step_image'][$i]);
            } else {
                $stepImage = $data['step_image_old'][$i];
            }

            $stepData[] = [
                'step_image' => $stepImage,
                'step_image_alt_tag' => $data['step_image_alt_tag'][$i],
                'step_title' => $data['step_title'][$i],
                'step_description' => $data['step_description'][$i],
                'step_button_text' => $data['step_button_text'][$i],
                'step_button_url' => $data['step_button_url'][$i],

            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_image']);
        unset($data['step_image_alt_tag']);
        unset($data['step_title']);
        unset($data['step_description']);
        unset($data['step_button_text']);
        unset($data['step_button_url']);


        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function prepareFeaturestyle25($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $stepData = [];

        if (!empty($data['image1'])) {
            $banner_image = $this->upload($data['image1']);
            $data['image1'] = $banner_image;
            if (isset($data['image1_old'])) {
                $this->deleteImage($data['image1_old']);
            }
        } else {
            $data['image1'] = $data['image1_old'];
        }

        foreach ($data['step_title'] as $i => $review) {

            $stepData[] = [
                'step_title' => $data['step_title'][$i],
                'step_sub_title' => $data['step_sub_title'][$i],
                'step_description' => $data['step_description'][$i],

            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_image']);
        unset($data['step_image_alt_tag']);
        unset($data['step_title']);
        unset($data['step_sub_title']);
        unset($data['step_description']);


        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function prepareFeaturestyle26($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $stepData = [];
        foreach ($data['step_title'] as $i => $review) {

            if (!empty($data['step_image_icon'][$i])) {
                $stepImage = $this->upload($data['step_image_icon'][$i]);

                if (isset($data['step_image_old'])) {
                    $this->deleteImage($data['step_image_old'][$i]);
                }
            } else {
                $stepImage = $data['step_image_old'][$i];
            }

            $stepData[] = [
                'step_title' => $data['step_title'][$i],
                'step_image' => $stepImage,
                'step_image_icon_alt_tag' => $data['step_image_icon_alt_tag'][$i],
                'step_description' => $data['step_description'][$i],

            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_title']);
        unset($data['step_description']);
        unset($data['step_image_icon']);
        unset($data['step_image_icon_alt_tag']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function prepareFeaturestyle27($data)
    {
        if (!empty($data['image'])) {
            $image = $this->upload($data['image']);
            $data['image'] = $image;
        } else {
            $data['image'] = $data['image_old'];
            unset($data['image_old']);
        }

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $stepData = [];
        foreach ($data['step_title'] as $i => $review) {
            if (!empty($data['step_image_icon'][$i])) {
                $stepImage = $this->upload($data['step_image_icon'][$i]);
                if (isset($data['step_image_old'])) {
                    $this->deleteImage($data['step_image_old'][$i]);
                }
            } else {
                $stepImage = $data['step_image_old'][$i];
            }
            $stepData[] = [
                'step_title' => $data['step_title'][$i],
                'step_image_icon_alt_tag' => $data['step_image_icon_alt_tag'][$i],
                'step_description' => $data['step_description'][$i],
                'step_image' => $stepImage,
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_title']);
        unset($data['step_description']);
        unset($data['step_image_icon']);
        unset($data['step_image_icon_alt_tag']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareFeaturestyle28($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $stepData = [];
        foreach ($data['step_title'] as $i => $review) {
            if (!empty($data['step_image_icon'][$i])) {
                $stepImage = $this->upload($data['step_image_icon'][$i]);
                if (isset($data['step_image_old'])) {
                    $this->deleteImage($data['step_image_old'][$i]);
                }
            } else {
                $stepImage = $data['step_image_old'][$i];
            }
            $stepData[] = [
                'step_title' => $data['step_title'][$i],
                'step_image_icon_alt_tag' => $data['step_image_icon_alt_tag'][$i],
                'link_text' => $data['link_text'][$i],
                'link_url' => $data['step_image_icon_alt_tag'][$i],
                'step_description' => $data['step_description'][$i],
                'step_image' => $stepImage,
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_title']);
        unset($data['step_description']);
        unset($data['link_text']);
        unset($data['link_url']);
        unset($data['step_image_icon']);
        unset($data['step_image_icon_alt_tag']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }



    public function prepareFeaturestyle29($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        if (!empty($data['image'])) {
            $image = $this->upload($data['image']);
            $data['image'] = $image;
            if (isset($data['image_old'])) {
                $this->deleteImage($data['image_old']);
            }
        } else {
            $data['image'] = $data['image_old'];
        }
        $stepData = [];
        foreach ($data['step_title'] as $i => $review) {
            $stepData[] = [
                'step_title' => $data['step_title'][$i],
                'step_subtitle' => $data['step_subtitle'][$i],
                'step_description' => $data['step_description'][$i],
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_title']);
        unset($data['step_description']);
        unset($data['step_subtitle']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareFeaturestyle31($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        if (!empty($data['image'])) {
            $image = $this->upload($data['image']);
            $data['image'] = $image;
        } else {
            $data['image'] = $data['image_old'];
            unset($data['image_old']);
        }
        $stepData = [];
        foreach ($data['step_title'] as $i => $review) {
            $stepData[] = [
                'step_title' => $data['step_title'][$i],
                'step_subtitle' => $data['step_subtitle'][$i],
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_title']);
        unset($data['step_subtitle']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }



    public function prepareFeaturestyle32($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $stepData = [];
        foreach ($data['step_description'] as $i => $review) {
            if (!empty($data['step_image_icon'][$i])) {
                $stepImage = $this->upload($data['step_image_icon'][$i]);
                if (isset($data['step_image_old'])) {
                    $this->deleteImage($data['step_image_old'][$i]);
                }
            } else {
                $stepImage = $data['step_image_old'][$i];
            }
            $stepData[] = [
                'step_image' => $stepImage,
                'step_image_icon_alt_tag' => $data['step_image_icon_alt_tag'][$i],
                'step_description' => $data['step_description'][$i],
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_description']);
        unset($data['step_image_icon']);
        unset($data['step_image_icon_alt_tag']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function prepareFeaturestyle33($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        if (!empty($data['banner_bg_image'])) {
            $banner_bg_image = $this->upload($data['banner_bg_image']);
            $data['banner_bg_image'] = $banner_bg_image;
            if (isset($data['banner_bg_image_old'])) {
                $this->deleteImage($data['banner_bg_image_old']);
            }
        } else {
            $data['banner_bg_image'] = $data['banner_bg_image_old'];
        }

        $stepData = [];
        foreach ($data['step_title'] as $i => $review) {
            if (!empty($data['step_image_icon'][$i])) {
                $stepImage = $this->upload($data['step_image_icon'][$i]);
                if (isset($data['step_image_old'])) {
                    $this->deleteImage($data['step_image_old'][$i]);
                }
            } else {
                $stepImage = $data['step_image_old'][$i];
            }
            $stepData[] = [
                'step_title' => $data['step_title'][$i],
                'step_image' => $stepImage,
                'step_image_icon_alt_tag' => $data['step_image_icon_alt_tag'][$i],
                'step_description' => $data['step_description'][$i],
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_description']);
        unset($data['step_image_icon']);
        unset($data['step_image_icon_alt_tag']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function prepareFeaturestyle34($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        if (!empty($data['image1'])) {
            $banner_image = $this->upload($data['image1']);
            $data['image1'] = $banner_image;
            if (isset($data['image1_old'])) {
                $this->deleteImage($data['image1_old']);
            }
        } else {
            $data['image1'] = $data['image1_old'];
        }

        if (!empty($data['image2'])) {
            $banner_image = $this->upload($data['image2']);
            $data['image2'] = $banner_image;
            if (isset($data['image2_old'])) {
                $this->deleteImage($data['image2_old']);
            }
        } else {
            $data['image2'] = $data['image2_old'];
        }

        if (!empty($data['image3'])) {
            $banner_image = $this->upload($data['image3']);
            $data['image3'] = $banner_image;
            if (isset($data['image3_old'])) {
                $this->deleteImage($data['image3_old']);
            }
        } else {
            $data['image3'] = $data['image3_old'];
        }

        $stepData = [];
        foreach ($data['step_title'] as $i => $review) {
            if (!empty($data['step_image_icon'][$i])) {
                $stepImage = $this->upload($data['step_image_icon'][$i]);
                if (isset($data['step_image_old'])) {
                    $this->deleteImage($data['step_image_old'][$i]);
                }
            } else {
                $stepImage = $data['step_image_old'][$i];
            }
            $stepData[] = [
                'step_title' => $data['step_title'][$i],
                'step_image' => $stepImage,
                'step_image_icon_alt_tag' => $data['step_image_icon_alt_tag'][$i],
                'step_description' => $data['step_description'][$i],
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_description']);
        unset($data['step_image_icon']);
        unset($data['step_image_icon_alt_tag']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareFeaturestyle35($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        if (!empty($data['image1'])) {
            $banner_image = $this->upload($data['image1']);
            $data['image1'] = $banner_image;
            if (isset($data['image1_old'])) {
                $this->deleteImage($data['image1_old']);
            }
        } else {
            $data['image1'] = $data['image1_old'];
        }

        if (!empty($data['image2'])) {
            $banner_image = $this->upload($data['image2']);
            $data['image2'] = $banner_image;
            if (isset($data['image2_old'])) {
                $this->deleteImage($data['image2_old']);
            }
        } else {
            $data['image2'] = $data['image2_old'];
        }


        if (!empty($data['image3'])) {
            $banner_image = $this->upload($data['image3']);
            $data['image3'] = $banner_image;
            if (isset($data['image3_old'])) {
                $this->deleteImage($data['image3_old']);
            }
        } else {
            $data['image3'] = $data['image3_old'];
        }

        if (!empty($data['image4'])) {
            $banner_image = $this->upload($data['image4']);
            $data['image4'] = $banner_image;
            if (isset($data['image4_old'])) {
                $this->deleteImage($data['image4_old']);
            }
        } else {
            $data['image4'] = $data['image4_old'];
        }



        $stepData = [];
        foreach ($data['step_title'] as $i => $review) {
            if (!empty($data['step_image_icon'][$i])) {
                $stepImage = $this->upload($data['step_image_icon'][$i]);
                if (isset($data['step_image_old'])) {
                    $this->deleteImage($data['step_image_old'][$i]);
                }
            } else {
                $stepImage = $data['step_image_old'][$i];
            }
            $stepData[] = [
                'step_title' => $data['step_title'][$i],
                'link_text' => $data['link_text'][$i],
                'link_url' => $data['link_url'][$i],
                'step_image' => $stepImage,
                'step_image_icon_alt_tag' => $data['step_image_icon_alt_tag'][$i],
                'step_description' => $data['step_description'][$i],
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_description']);
        unset($data['step_image_icon']);
        unset($data['step_image_icon_alt_tag']);
        unset($data['link_url']);
        unset($data['link_text']);
        unset($data['step_title']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function prepareFeaturestyle36($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        $stepData = [];
        foreach ($data['step_title'] as $i => $review) {
            if (!empty($data['step_image_icon'][$i])) {
                $stepImage = $this->upload($data['step_image_icon'][$i]);
                if (isset($data['step_image_old'])) {
                    $this->deleteImage($data['step_image_old'][$i]);
                }
            } else {
                $stepImage = $data['step_image_old'][$i];
            }
            $stepData[] = [
                'step_title' => $data['step_title'][$i],
                'link_text' => $data['link_text'][$i],
                'link_url' => $data['link_url'][$i],
                'step_image' => $stepImage,
                'step_image_icon_alt_tag' => $data['step_image_icon_alt_tag'][$i],
                'step_description' => $data['step_description'][$i],
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_description']);
        unset($data['step_image_icon']);
        unset($data['step_image_icon_alt_tag']);
        unset($data['link_url']);
        unset($data['link_text']);
        unset($data['step_title']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }



    public function prepareFeaturestyle37($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        if (!empty($data['image1'])) {
            $banner_image = $this->upload($data['image1']);
            $data['image1'] = $banner_image;
            if (isset($data['image1_old'])) {
                $this->deleteImage($data['image1_old']);
            }
        } else {
            $data['image1'] = $data['image1_old'];
        }

        if (!empty($data['image2'])) {
            $banner_image = $this->upload($data['image2']);
            $data['image2'] = $banner_image;
            if (isset($data['image2_old'])) {
                $this->deleteImage($data['image2_old']);
            }
        } else {
            $data['image2'] = $data['image2_old'];
        }


        if (!empty($data['image3'])) {
            $banner_image = $this->upload($data['image3']);
            $data['image3'] = $banner_image;
            if (isset($data['image3_old'])) {
                $this->deleteImage($data['image3_old']);
            }
        } else {
            $data['image3'] = $data['image3_old'];
        }

        $stepData = [];
        foreach ($data['step_title'] as $i => $review) {
            if (!empty($data['step_image_icon'][$i])) {
                $stepImage = $this->upload($data['step_image_icon'][$i]);
                if (isset($data['step_image_old'])) {
                    $this->deleteImage($data['step_image_old'][$i]);
                }
            } else {
                $stepImage = $data['step_image_old'][$i];
            }
            $stepData[] = [
                'step_title' => $data['step_title'][$i],
                'step_sub_title' => $data['step_sub_title'][$i],
                'step_image' => $stepImage,
                'step_image_icon_alt_tag' => $data['step_image_icon_alt_tag'][$i],
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_image_icon']);
        unset($data['step_image_icon_alt_tag']);
        unset($data['step_title']);
        unset($data['step_sub_title']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }



    public function prepareFeaturestyle38($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);


        $stepData = [];
        foreach ($data['step_title'] as $i => $review) {
            if (!empty($data['step_image_icon'][$i])) {
                $stepImage = $this->upload($data['step_image_icon'][$i]);
                if (isset($data['step_image_old'])) {
                    $this->deleteImage($data['step_image_old'][$i]);
                }
            } else {
                $stepImage = $data['step_image_old'][$i];
            }
            $stepData[] = [
                'step_title' => $data['step_title'][$i],
                'step_image' => $stepImage,
                'step_image_icon_alt_tag' => $data['step_image_icon_alt_tag'][$i],
                'step_description' => $data['step_description'][$i],
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_image_icon']);
        unset($data['step_image_icon_alt_tag']);
        unset($data['step_title']);
        unset($data['step_description']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function prepareFeaturestyle39($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);


        $stepData = [];
        foreach ($data['step_title'] as $i => $review) {
            if (!empty($data['step_image_icon'][$i])) {
                $stepImage = $this->upload($data['step_image_icon'][$i]);
                if (isset($data['step_image_old'])) {
                    $this->deleteImage($data['step_image_old'][$i]);
                }
            } else {
                $stepImage = $data['step_image_old'][$i];
            }
            $stepData[] = [
                'step_title' => $data['step_title'][$i],
                'link_text' => $data['link_text'][$i],
                'link_url' => $data['link_url'][$i],
                'step_image' => $stepImage,
                'step_image_icon_alt_tag' => $data['step_image_icon_alt_tag'][$i],
                'step_description' => $data['step_description'][$i],
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_image_icon']);
        unset($data['step_image_icon_alt_tag']);
        unset($data['step_title']);
        unset($data['link_text']);
        unset($data['link_url']);
        unset($data['step_description']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function prepareFeaturestyle40($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);


        $stepData = [];
        foreach ($data['step_title'] as $i => $review) {
            if (!empty($data['step_image_icon'][$i])) {
                $stepImage = $this->upload($data['step_image_icon'][$i]);
                if (isset($data['step_image_old'])) {
                    $this->deleteImage($data['step_image_old'][$i]);
                }
            } else {
                $stepImage = $data['step_image_old'][$i];
            }
            $stepData[] = [
                'step_title' => $data['step_title'][$i],
                'step_sub_title' => $data['step_sub_title'][$i],
                'step_image' => $stepImage,
                'step_image_icon_alt_tag' => $data['step_image_icon_alt_tag'][$i],
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_image_icon']);
        unset($data['step_image_icon_alt_tag']);
        unset($data['step_title']);
        unset($data['step_sub_title']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function prepareIntigrationstyle1($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $stepData = [];
        foreach ($data['card_title'] as $i => $review) {
            if (!empty($data['image_icon'][$i])) {
                $stepImage = $this->upload($data['image_icon'][$i]);
            } else {
                $stepImage = $data['step_image_old'][$i];
            }

            $stepData[] = [
                'step_title' => $data['card_title'][$i],
                'step_image_icon_alt_tag' => $data['image_icon_alt_tag'][$i],
                'step_button_text' => $data['step_button_text'][$i],
                'step_button_url' => $data['step_button_url'][$i],
                'step_description' => $data['card_description'][$i],
                'step_image' => $stepImage,
            ];
        }

        $data['step_data'] = $stepData;

        unset($data['card_title']);
        unset($data['image_icon_alt_tag']);
        unset($data['step_button_text']);
        unset($data['step_button_url']);
        unset($data['card_description']);

        $leftIconImage = [];
        if (!empty($data['left_image_icon'])) {
            foreach ($data['left_image_icon'] as $i => $clientImg) {
                $leftIconImage[] = [
                    'left_image_icon' => $this->upload($clientImg),
                    'left_icon_alt_tag' => $data['left_icon_alt_tag'][$i],
                ];
            }
            $data['left_icon'] = $leftIconImage;
        } else {
            if (!empty($data['left_image_icon_old'])) {
                foreach ($data['left_image_icon_old'] as $i => $clientImg) {
                    $leftIconImage[] = [
                        'left_image_icon' => $data['left_image_icon_old'][$i],
                        'left_icon_alt_tag' => $data['left_icon_alt_tag'][$i],
                    ];
                }
                $data['left_icon'] = $leftIconImage;
                unset($data['left_image_icon_old']);
            }
        }
        unset($data['left_image_icon']);
        unset($data['left_icon_alt_tag']);

        $rightIconImage = [];
        if (!empty($data['right_image_icon'])) {
            foreach ($data['right_image_icon'] as $i => $clientImg) {
                $rightIconImage[] = [
                    'right_image_icon' => $this->upload($clientImg),
                    'right_icon_alt_tag' => $data['right_icon_alt_tag'][$i],
                ];
            }
            $data['right_icon'] = $rightIconImage;
        } else {
            if (!empty($data['right_image_icon_old'])) {
                foreach ($data['right_image_icon_old'] as $i => $clientImg) {
                    $rightIconImage[] = [
                        'right_image_icon' => $data['right_image_icon_old'][$i],
                        'right_icon_alt_tag' => $data['right_icon_alt_tag'][$i],
                    ];
                }
                $data['right_icon'] = $rightIconImage;
            }
        }


        unset($data['right_image_icon']);
        unset($data['right_icon_alt_tag']);

        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareIntigrationstyle2($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $stepData = [];

        foreach ($data['card_title'] as $i => $review) {
            if (!empty($data['image_icon'][$i])) {
                $stepImage = $this->upload($data['image_icon'][$i]);
            } else {
                $stepImage = $data['step_image_old'][$i];
            }

            $stepData[] = [
                'step_title' => $data['card_title'][$i],
                'step_image_icon_alt_tag' => $data['image_icon_alt_tag'][$i],
                'step_image' => $stepImage,
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['card_title']);
        unset($data['image_icon_alt_tag']);


        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function prepareIntigrationstyle3($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        if (!empty($data['banner_image'])) {
            $banner_image = $this->upload($data['banner_image']);
            $data['banner_image'] = $banner_image;
            if (isset($data['banner_image_old'])) {
                $this->deleteImage($data['banner_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_image_old'];
        }

        if (!empty($data['banner_image1'])) {
            $bannerImage1 = $this->upload($data['banner_image1']);
            $data['banner_image1'] = $bannerImage1;
            if (isset($data['banner_image1_old'])) {
                $this->deleteImage($data['banner_image1_old']);
            }
        } else {
            $data['banner_image1'] = $data['banner_image1_old'];
        }
        $stepData = [];

        foreach ($data['card_title'] as $i => $review) {
            if (!empty($data['step_image'][$i])) {
                $stepImage = $this->upload($data['step_image'][$i]);
            } else {
                $stepImage = $data['step_image_old'][$i];
            }

            $stepData[] = [
                'step_title' => $data['card_title'][$i],
                'step_image_icon_alt_tag' => $data['image_icon_alt_tag'][$i],
                'step_description' => $data['step_description'][$i],
                'step_image' => $stepImage,
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['card_title']);
        unset($data['image_icon_alt_tag']);
        unset($data['step_description']);


        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function prepareIntigrationstyle6($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $stepData = [];

        foreach ($data['step_title'] as $i => $review) {
            if (!empty($data['step_image'][$i])) {
                $stepImage = $this->upload($data['step_image'][$i]);
            } else {
                $stepImage = $data['step_image_old'][$i];
            }

            $stepData[] = [
                'step_image' => $stepImage,
                'step_image_alt_tag' => $data['step_image_alt_tag'][$i],
                'step_title' => $data['step_title'][$i],
                'short_description' => $data['short_description'][$i],

            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_image']);
        unset($data['step_image_alt_tag']);
        unset($data['step_title']);
        unset($data['short_description']);


        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function prepareIntigrationstyle7($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        if (!empty($data['banner_image'])) {
            $banner_image = $this->upload($data['banner_image']);
            $data['banner_image'] = $banner_image;
            if (isset($data['banner_image_old'])) {
                $this->deleteImage($data['banner_image_old']);
            }
        } else {
            $data['banner_image'] = $data['banner_image_old'];
        }


        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareIntigrationstyle8($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        if (!empty($data['banner_bg_image'])) {
            $banner_bg_image = $this->upload($data['banner_bg_image']);
            $data['banner_bg_image'] = $banner_bg_image;
            if (isset($data['banner_bg_image_old'])) {
                $this->deleteImage($data['banner_bg_image_old']);
            }
        } else {
            $data['banner_bg_image'] = $data['banner_bg_image_old'];
        }


        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareIntigrationstyle9($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        if (!empty($data['image1'])) {
            $banner_image = $this->upload($data['image1']);
            $data['image1'] = $banner_image;
            if (isset($data['image1_old'])) {
                $this->deleteImage($data['image1_old']);
            }
        } else {
            $data['image1'] = $data['image1_old'];
        }

        $stepData = [];
        foreach ($data['step_title'] as $i => $review) {
            if (!empty($data['step_image_icon'][$i])) {
                $stepImage = $this->upload($data['step_image_icon'][$i]);
                if (isset($data['step_image_old'])) {
                    $this->deleteImage($data['step_image_old'][$i]);
                }
            } else {
                $stepImage = $data['step_image_old'][$i];
            }
            $stepData[] = [
                'step_title' => $data['step_title'][$i],
                'step_image' => $stepImage,
                'step_image_icon_alt_tag' => $data['step_image_icon_alt_tag'][$i],
                'step_description' => $data['step_description'][$i],

            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_image_icon']);
        unset($data['step_image_icon_alt_tag']);
        unset($data['step_title']);
        unset($data['step_description']);
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareIntigrationstyle10($data)
    {
        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        if (!empty($data['image1'])) {
            $banner_image = $this->upload($data['image1']);
            $data['image1'] = $banner_image;
            if (isset($data['image1_old'])) {
                $this->deleteImage($data['image1_old']);
            }
        } else {
            $data['image1'] = $data['image1_old'];
        }

        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareblogstyle1($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $stepData = [];
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function prepareteamstyle1($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $stepData = [];
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function prepareteamstyle7($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        if (!empty($data['banner_bg_image'])) {
            $banner_bg_image = $this->upload($data['banner_bg_image']);
            $data['banner_bg_image'] = $banner_bg_image;
            if (isset($data['banner_bg_image_old'])) {
                $this->deleteImage($data['banner_bg_image_old']);
            }
        } else {
            $data['banner_bg_image'] = $data['banner_bg_image_old'];
        }
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function preparecontacttyle1($data)
    {
        // Handle the main image upload or retain the old image
        if (!empty($data['image'])) {
            $data['image'] = $this->upload($data['image']);
        } else {
            $data['image'] = $data['image_old'];
        }

        $stepData = []; // Initialize an empty array to hold step data

        // Prepare form HTML content
        $formHtml = $data['html_content'];
        unset($data['html_content']);

        // Check if there are step titles and process each step
        if (isset($data['step_title']) && !empty($data['step_title'][0])) {
            foreach ($data['step_title'] as $i => $title) {
                // Handle step image upload or retain the old image
                if (!empty($data['step_image'][$i])) {
                    $stepImage = $this->upload($data['step_image'][$i]);
                } else {
                    $stepImage = $data['step_image_old'][$i] ?? null;
                }

                // Prepare step data
                $stepData[] = [
                    'step_title' => $title,
                    'step_image_alt_tag' => $data['step_image_alt_tag'][$i] ?? '',
                    'link_text' => $data['link_text'][$i] ?? '',
                    'link_url' => $data['link_url'][$i] ?? '',
                    'step_description' => $data['step_description'][$i] ?? '',
                    'step_image' => $stepImage,
                ];
            }

            $data['step_data'] = $stepData;

            // Unset the processed data to avoid redundancy
            unset($data['step_title'], $data['step_image'], $data['step_image_alt_tag'], $data['link_text'], $data['link_url'], $data['step_description']);
        }

        // Prepare the final data array for storage
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $formHtml,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function preparecontacttyle2($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);


        $stepData = [];

        foreach ($data['card_title'] as $i => $review) {
            if (!empty($data['step_image'][$i])) {
                $stepImage = $this->upload($data['step_image'][$i]);
            } else {
                $stepImage = $data['step_image_old'][$i];
            }

            $stepData[] = [
                'step_title' => $data['card_title'][$i],
                'step_link_text' => $data['step_link_text'][$i],
                'step_link_url' => $data['step_link_url'][$i],
                'step_image_icon_alt_tag' => $data['image_icon_alt_tag'][$i],
                'step_description' => $data['step_description'][$i],
                'step_image' => $stepImage,
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['card_title']);
        unset($data['image_icon_alt_tag']);
        unset($data['link_text']);
        unset($data['link_url']);
        unset($data['step_description']);


        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function preparecontacttyle3($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);


        $stepData = [];

        foreach ($data['step_title'] as $i => $review) {
            if (!empty($data['step_image'][$i])) {
                $stepImage = $this->upload($data['step_image'][$i]);
            } else {
                $stepImage = $data['step_image_old'][$i];
            }

            $stepData[] = [
                'step_title' => $data['step_title'][$i],
                'step_sub_title' => $data['step_sub_title'][$i],
                'step_image_alt_tag' => $data['step_image_alt_tag'][$i],
                'step_image' => $stepImage,
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['step_title']);
        unset($data['step_sub_title']);
        unset($data['step_image_alt_tag']);
        unset($data['step_description']);


        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function preparecontacttyle4($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        if (!empty($data['banner_bg_image'])) {
            $banner_bg_image = $this->upload($data['banner_bg_image']);
            $data['banner_bg_image'] = $banner_bg_image;
            if (isset($data['banner_bg_image_old'])) {
                $this->deleteImage($data['banner_bg_image_old']);
            }
        } else {
            $data['banner_bg_image'] = $data['banner_bg_image_old'];
        }

        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function preparecontacttyle5($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);



        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function preparehelpcenterstyle1($data)
    {
        // Handle the main image upload or retain the old image
        if (!empty($data['banner_bg_image'])) {
            $banner_bg_image = $this->upload($data['banner_bg_image']);
            $data['banner_bg_image'] = $banner_bg_image;

            if (isset($data['banner_bg_image_old'])) {
                $this->deleteImage($data['banner_bg_image_old']);
            }
        } else {
            $data['banner_bg_image'] = $data['banner_bg_image_old'];
        }
        $stepData = []; // Initialize an empty array to hold step data
        // Prepare form HTML content
        $formHtml = $data['html_content'];
        unset($data['html_content']);

        // Check if there are step titles and process each step
        if (isset($data['step_text']) && !empty($data['step_text'][0])) {
            foreach ($data['step_text'] as $i => $stepText) {
                // Handle step image upload or retain the old image
                if (!empty($data['step_image_icon'][$i])) {
                    $stepImage = $this->upload($data['step_image_icon'][$i]);
                } else {
                    $stepImage = $data['step_image_old'][$i] ?? null;
                }

                // Prepare step data
                $stepData[] = [
                    'step_image' => $stepImage,
                    'step_image_alt_tag' => $data['step_image_icon_alt_tag'][$i] ?? '',
                    'step_text' => $data['step_text'][$i] ?? '',
                    'text_url' => $data['text_url'][$i] ?? '',
                ];
            }

            $data['step_data'] = $stepData;

            // Unset the processed data to avoid redundancy
            unset($data['step_image_icon'], $data['step_image_icon_alt_tag'], $data['step_text'], $data['text_url']);
        }

        // Prepare the final data array for storage
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $formHtml,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function preparePortfoliostyle1($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);


        $stepData = [];

        foreach ($data['category'] as $i => $review) {
            if (!empty($data['step_image_icon'][$i])) {
                $stepImageIcon = $this->upload($data['step_image_icon'][$i]);
            } else {
                $stepImageIcon = $data['step_image_icon_old'][$i];
            }

            if (!empty($data['step_image'][$i])) {
                $stepImage = $this->upload($data['step_image'][$i]);
            } else {
                $stepImage = $data['step_image_old'][$i];
            }

            $portSlug = date('YmdHis') . preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($data['portfolio_title'][$i]));


            $stepData[] = [
                'category' => $data['category'][$i],
                'step_title' => $data['portfolio_title'][$i],
                'step_image_alt_tag' => $data['step_image_alt_tag'][$i],
                'step_image_icon_alt_tag' => $data['step_image_icon_alt_tag'][$i],
                'detail_title' => $data['client'][$i],
                'port_slug' => $portSlug,
                'client' => $data['client'][$i],
                'service' => $data['service'][$i],
                'description' => $data['description'][$i],
                'step_image_icon' => $stepImageIcon,
                'step_image' => $stepImage,
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['category']);
        unset($data['portfolio_title']);
        unset($data['step_image_alt_tag']);
        unset($data['step_image_icon_alt_tag']);
        unset($data['client']);
        unset($data['service']);
        unset($data['description']);
        unset($data['detail_title']);


        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }



    public function preparePortfoliostyle2($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);


        $stepData = [];

        foreach ($data['category'] as $i => $review) {
            if (!empty($data['step_image_icon'][$i])) {
                $stepImageIcon = $this->upload($data['step_image_icon'][$i]);
            } else {
                $stepImageIcon = $data['step_image_icon_old'][$i];
            }

            if (!empty($data['step_image'][$i])) {
                $stepImage = $this->upload($data['step_image'][$i]);
            } else {
                $stepImage = $data['step_image_old'][$i];
            }

            $portSlug = date('YmdHis') . preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($data['portfolio_title'][$i]));


            $stepData[] = [
                'category' => $data['category'][$i],
                'step_title' => $data['portfolio_title'][$i],
                'step_image_alt_tag' => $data['step_image_alt_tag'][$i],
                'step_image_icon_alt_tag' => $data['step_image_icon_alt_tag'][$i],
                'detail_title' => $data['client'][$i],
                'port_slug' => $portSlug,
                'client' => $data['client'][$i],
                'service' => $data['service'][$i],
                'description' => $data['description'][$i],
                'step_image_icon' => $stepImageIcon,
                'step_image' => $stepImage,
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['category']);
        unset($data['portfolio_title']);
        unset($data['step_image_alt_tag']);
        unset($data['step_image_icon_alt_tag']);
        unset($data['client']);
        unset($data['service']);
        unset($data['description']);
        unset($data['detail_title']);


        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function preparePortfoliostyle3($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);


        $stepData = [];

        foreach ($data['category'] as $i => $review) {
            if (!empty($data['step_image_icon'][$i])) {
                $stepImageIcon = $this->upload($data['step_image_icon'][$i]);
            } else {
                $stepImageIcon = $data['step_image_icon_old'][$i];
            }

            if (!empty($data['step_image'][$i])) {
                $stepImage = $this->upload($data['step_image'][$i]);
            } else {
                $stepImage = $data['step_image_old'][$i];
            }

            $portSlug = date('YmdHis') . preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($data['portfolio_title'][$i]));


            $stepData[] = [
                'category' => $data['category'][$i],
                'step_title' => $data['portfolio_title'][$i],
                'step_image_alt_tag' => $data['step_image_alt_tag'][$i],
                'step_image_icon_alt_tag' => $data['step_image_icon_alt_tag'][$i],
                'detail_title' => $data['client'][$i],
                'port_slug' => $portSlug,
                'client' => $data['client'][$i],
                'service' => $data['service'][$i],
                'description' => $data['description'][$i],
                'step_image_icon' => $stepImageIcon,
                'step_image' => $stepImage,
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['category']);
        unset($data['portfolio_title']);
        unset($data['step_image_alt_tag']);
        unset($data['step_image_icon_alt_tag']);
        unset($data['client']);
        unset($data['service']);
        unset($data['description']);
        unset($data['detail_title']);


        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function preparePortfoliostyle4($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);


        $stepData = [];

        foreach ($data['category'] as $i => $review) {
            if (!empty($data['step_image_icon'][$i])) {
                $stepImageIcon = $this->upload($data['step_image_icon'][$i]);
            } else {
                $stepImageIcon = $data['step_image_icon_old'][$i];
            }

            if (!empty($data['step_image'][$i])) {
                $stepImage = $this->upload($data['step_image'][$i]);
            } else {
                $stepImage = $data['step_image_old'][$i];
            }

            $portSlug = date('YmdHis') . preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($data['portfolio_title'][$i]));


            $stepData[] = [
                'category' => $data['category'][$i],
                'step_title' => $data['portfolio_title'][$i],
                'step_image_alt_tag' => $data['step_image_alt_tag'][$i],
                'step_image_icon_alt_tag' => $data['step_image_icon_alt_tag'][$i],
                'detail_title' => $data['client'][$i],
                'port_slug' => $portSlug,
                'client' => $data['client'][$i],
                'service' => $data['service'][$i],
                'description' => $data['description'][$i],
                'step_image_icon' => $stepImageIcon,
                'step_image' => $stepImage,
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['category']);
        unset($data['portfolio_title']);
        unset($data['step_image_alt_tag']);
        unset($data['step_image_icon_alt_tag']);
        unset($data['client']);
        unset($data['service']);
        unset($data['description']);
        unset($data['detail_title']);
        unset($data['step_image']);
        unset($data['step_image_icon']);


        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function preparePortfoliostyle7($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

        if (!empty($data['image1'])) {
            $data['image1'] = $this->upload($data['image1']);
        } else {
            $data['image1'] = $data['image1_old'];
        }

        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function preparePortfoliostyle9($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);


        $stepData = [];

        foreach ($data['category'] as $i => $review) {
            if (!empty($data['step_image_icon'][$i])) {
                $stepImageIcon = $this->upload($data['step_image_icon'][$i]);
            } else {
                $stepImageIcon = $data['step_image_icon_old'][$i];
            }

            if (!empty($data['step_image'][$i])) {
                $stepImage = $this->upload($data['step_image'][$i]);
            } else {
                $stepImage = $data['step_image_old'][$i];
            }

            $portSlug = date('YmdHis') . preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($data['portfolio_title'][$i]));


            $stepData[] = [
                'category' => $data['category'][$i],
                'step_title' => $data['portfolio_title'][$i],
                'step_image_alt_tag' => $data['step_image_alt_tag'][$i],
                'step_image_icon_alt_tag' => $data['step_image_icon_alt_tag'][$i],
                'detail_title' => $data['client'][$i],
                'port_slug' => $portSlug,
                'client' => $data['client'][$i],
                'service' => $data['service'][$i],
                'description' => $data['description'][$i],
                'step_image_icon' => $stepImageIcon,
                'step_image' => $stepImage,
            ];
        }
        $data['step_data'] = $stepData;
        unset($data['category']);
        unset($data['portfolio_title']);
        unset($data['step_image_alt_tag']);
        unset($data['step_image_icon_alt_tag']);
        unset($data['client']);
        unset($data['service']);
        unset($data['description']);
        unset($data['detail_title']);
        unset($data['step_image']);
        unset($data['step_image_icon']);

        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function preparePortfoliostyle12($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);


        $stepData = [];

        // Determine the number of steps based on the existing or new images
        $maxSteps = max(
            isset($data['step_image_icon']) ? count($data['step_image_icon']) : 0,
            isset($data['step_image_icon_old']) ? count($data['step_image_icon_old']) : 0
        );

        for ($i = 0; $i < $maxSteps; $i++) {
            // Check if a new image is uploaded
            if (!empty($data['step_image_icon'][$i] ?? null)) {
                $stepImageIcon = $this->upload($data['step_image_icon'][$i]);

                // Delete old image only if a new one is uploaded
                if (!empty($data['step_image_icon_old'][$i] ?? null)) {
                    $this->deleteImage($data['step_image_icon_old'][$i]);
                }
            } else {
                // If no new image is uploaded, use the old image
                $stepImageIcon = $data['step_image_icon_old'][$i] ?? null;
            }

            $stepData[] = [
                'step_image_icon_alt_tag' => $data['step_image_icon_alt_tag'][$i] ?? null,
                'step_image_icon' => $stepImageIcon,
            ];
        }


        $data['step_data'] = $stepData;
        unset($data['step_image_icon_alt_tag']);


        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function preparePortfoliostyle13($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

    
        $stepData = [];

        foreach ($data['category'] as $i => $review) {
            if (!empty($data['step_image_icon'][$i])) {
                $stepImageIcon = $this->upload($data['step_image_icon'][$i]);
            } else {
                $stepImageIcon = $data['step_image_icon_old'][$i];
            }

            if (!empty($data['step_image'][$i])) {
                $stepImage = $this->upload($data['step_image'][$i]);
            } else {
                $stepImage = $data['step_image_old'][$i];
            }

            $portSlug = date('YmdHis') . preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($data['portfolio_title'][$i]));


            $stepData[] = [
                'category' => $data['category'][$i],
                'step_title' => $data['portfolio_title'][$i],
                'step_image_alt_tag' => $data['step_image_alt_tag'][$i],
                'step_image_icon_alt_tag' => $data['step_image_icon_alt_tag'][$i],
                'detail_title' => $data['client'][$i],
                'port_slug' => $portSlug,
                'client' => $data['client'][$i],
                'short_description' => $data['short_description'][$i],
                'service' => $data['service'][$i],
                'description' => $data['description'][$i],
                'step_image_icon' => $stepImageIcon,
                'step_image' => $stepImage,
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['category']);
        unset($data['portfolio_title']);
        unset($data['step_image_alt_tag']);
        unset($data['step_image_icon_alt_tag']);
        unset($data['client']);
        unset($data['service']);
        unset($data['description']);
        unset($data['detail_title']);
        unset($data['short_description']);


        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

     public function preparePortfoliostyle14($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

       if (!empty($data['banner_bg_image'])) {
            $banner_bg_image = $this->upload($data['banner_bg_image']);
            $data['banner_bg_image'] = $banner_bg_image;

            if (isset($data['banner_bg_image_old'])) {
                $this->deleteImage($data['banner_bg_image_old']);
            }
        } else {
            $data['banner_bg_image'] = $data['banner_bg_image_old'];
        }
        
        $stepData = [];

        foreach ($data['category'] as $i => $review) {
            if (!empty($data['step_image_icon'][$i])) {
                $stepImageIcon = $this->upload($data['step_image_icon'][$i]);
            } else {
                $stepImageIcon = $data['step_image_icon_old'][$i];
            }

            if (!empty($data['step_image'][$i])) {
                $stepImage = $this->upload($data['step_image'][$i]);
            } else {
                $stepImage = $data['step_image_old'][$i];
            }

            $portSlug = date('YmdHis') . preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($data['portfolio_title'][$i]));


            $stepData[] = [
                'category' => $data['category'][$i],
                'step_title' => $data['portfolio_title'][$i],
                'step_image_alt_tag' => $data['step_image_alt_tag'][$i],
                'step_image_icon_alt_tag' => $data['step_image_icon_alt_tag'][$i],
                'detail_title' => $data['client'][$i],
                'port_slug' => $portSlug,
                'client' => $data['client'][$i],
                'service' => $data['service'][$i],
                'description' => $data['description'][$i],
                'step_image_icon' => $stepImageIcon,
                'step_image' => $stepImage,
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['category']);
        unset($data['portfolio_title']);
        unset($data['step_image_alt_tag']);
        unset($data['step_image_icon_alt_tag']);
        unset($data['client']);
        unset($data['service']);
        unset($data['description']);
        unset($data['detail_title']);


        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


     public function preparePortfoliostyle15($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

       if (!empty($data['banner_bg_image'])) {
            $banner_bg_image = $this->upload($data['banner_bg_image']);
            $data['banner_bg_image'] = $banner_bg_image;

            if (isset($data['banner_bg_image_old'])) {
                $this->deleteImage($data['banner_bg_image_old']);
            }
        } else {
            $data['banner_bg_image'] = $data['banner_bg_image_old'];
        }
        
        $stepData = [];

        foreach ($data['category'] as $i => $review) {
            if (!empty($data['step_image_icon'][$i])) {
                $stepImageIcon = $this->upload($data['step_image_icon'][$i]);
            } else {
                $stepImageIcon = $data['step_image_icon_old'][$i];
            }

            if (!empty($data['step_image'][$i])) {
                $stepImage = $this->upload($data['step_image'][$i]);
            } else {
                $stepImage = $data['step_image_old'][$i];
            }

            $portSlug = date('YmdHis') . preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($data['portfolio_title'][$i]));


            $stepData[] = [
                'category' => $data['category'][$i],
                'step_title' => $data['portfolio_title'][$i],
                'step_image_alt_tag' => $data['step_image_alt_tag'][$i],
                'step_image_icon_alt_tag' => $data['step_image_icon_alt_tag'][$i],
                'detail_title' => $data['client'][$i],
                'port_slug' => $portSlug,
                'client' => $data['client'][$i],
                'short_description' => $data['short_description'][$i],
                'service' => $data['service'][$i],
                'description' => $data['description'][$i],
                'step_image_icon' => $stepImageIcon,
                'step_image' => $stepImage,
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['category']);
        unset($data['portfolio_title']);
        unset($data['step_image_alt_tag']);
        unset($data['step_image_icon_alt_tag']);
        unset($data['client']);
        unset($data['service']);
        unset($data['description']);
        unset($data['detail_title']);


        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


      public function preparePortfoliostyle16($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

    
        $stepData = [];

        foreach ($data['category'] as $i => $review) {
            if (!empty($data['step_image_icon'][$i])) {
                $stepImageIcon = $this->upload($data['step_image_icon'][$i]);
            } else {
                $stepImageIcon = $data['step_image_icon_old'][$i];
            }

            if (!empty($data['step_image'][$i])) {
                $stepImage = $this->upload($data['step_image'][$i]);
            } else {
                $stepImage = $data['step_image_old'][$i];
            }

            $portSlug = date('YmdHis') . preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($data['portfolio_title'][$i]));


            $stepData[] = [
                'category' => $data['category'][$i],
                'step_title' => $data['portfolio_title'][$i],
                'step_image_alt_tag' => $data['step_image_alt_tag'][$i],
                'step_image_icon_alt_tag' => $data['step_image_icon_alt_tag'][$i],
                'detail_title' => $data['client'][$i],
                'port_slug' => $portSlug,
                'client' => $data['client'][$i],
                'short_description' => $data['short_description'][$i],
                'service' => $data['service'][$i],
                'description' => $data['description'][$i],
                'step_image_icon' => $stepImageIcon,
                'step_image' => $stepImage,
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['category']);
        unset($data['portfolio_title']);
        unset($data['step_image_alt_tag']);
        unset($data['step_image_icon_alt_tag']);
        unset($data['client']);
        unset($data['service']);
        unset($data['description']);
        unset($data['detail_title']);
        unset($data['short_description']);


        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


       public function preparePortfoliostyle17($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);

    
        $stepData = [];

        foreach ($data['category'] as $i => $review) {
            if (!empty($data['step_image_icon'][$i])) {
                $stepImageIcon = $this->upload($data['step_image_icon'][$i]);
            } else {
                $stepImageIcon = $data['step_image_icon_old'][$i];
            }

            if (!empty($data['step_image'][$i])) {
                $stepImage = $this->upload($data['step_image'][$i]);
            } else {
                $stepImage = $data['step_image_old'][$i];
            }

            $portSlug = date('YmdHis') . preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($data['portfolio_title'][$i]));


            $stepData[] = [
                'category' => $data['category'][$i],
                'step_title' => $data['portfolio_title'][$i],
                'step_image_alt_tag' => $data['step_image_alt_tag'][$i],
                'step_image_icon_alt_tag' => $data['step_image_icon_alt_tag'][$i],
                'detail_title' => $data['client'][$i],
                'port_slug' => $portSlug,
                'client' => $data['client'][$i],
                'service' => $data['service'][$i],
                'description' => $data['description'][$i],
                'step_image_icon' => $stepImageIcon,
                'step_image' => $stepImage,
            ];
        }

        $data['step_data'] = $stepData;
        unset($data['category']);
        unset($data['portfolio_title']);
        unset($data['step_image_alt_tag']);
        unset($data['step_image_icon_alt_tag']);
        unset($data['client']);
        unset($data['service']);
        unset($data['description']);
        unset($data['detail_title']);


        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }


    public function privacyTermsstyle1($data)
    {

        $datanew['form_html'] = $this->removeCkEditorWrapper($data['html_content']);
        unset($data['html_content']);
        //  dd(json_encode($data, true));
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }
    private function removeCkEditorWrapper($htmlContent)
    {
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true); // Prevent HTML parsing errors
        $dom->loadHTML(mb_convert_encoding($htmlContent, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        $xpath = new \DOMXPath($dom);

        // Find all divs with the CKEditor classes
        foreach ($xpath->query('//div[contains(@class, "ck ck-reset ck-editor ck-rounded-corners")]') as $div) {
            $div->parentNode->removeChild($div);
        }

        return $dom->saveHTML();
    }
    public function preparecareerstyle1($data)
    {
    
        // Prepare form HTML content
        $formHtml = $data['html_content'];
        unset($data['html_content']);
        // Prepare the final data array for storage
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $formHtml,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    
        return $storeData;
    }


    public function prepareDepartmentstyle1($data)
    {

        $datanew['form_html'] = $data['html_content'];
        unset($data['html_content']);
        $stepData = [];
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $datanew['form_html'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $storeData;
    }

    public function preparelocationstyle1($data)
    {
    
        // Prepare form HTML content
        $formHtml = $data['html_content'];
        unset($data['html_content']);
        // Prepare the final data array for storage
        $storeData = [
            'page_id' => $data['page_id'],
            'section_id' => $data['section_id'],
            'section_style_id' => $data['section_style_id'],
            'sort_id' => $data['sort_id'],
            'status' => $data['status'],
            'page_section_data' => json_encode($data, true),
            'html_content' => $formHtml,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    
        return $storeData;
    }

    public function upload(UploadedFile $file)
    {
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('uploads', $filename, 'public');
        return $filename;
    }
    public function deleteImage($filename)
    {
        $filePath = 'public/uploads/' . $filename;
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
    }
}
