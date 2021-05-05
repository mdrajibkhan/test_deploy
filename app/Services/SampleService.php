<?php 

namespace App\Services;

use App\Models\Sample;
use App\Repositories\SampleRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class SampleService
{
    /**
     * @var $sampleRepository
     */
    protected $sampleRepository;

    /**
     * SampleService constructor.
     *
     * @param SampleRepository $sampleRepository
     */
    public function __construct(SampleRepository $sampleRepository)
    {
        $this->sampleRepository = $sampleRepository;
    }


    /**
     * Get all sample.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->sampleRepository->getAll();
    }

    /**
     * Get sample by id.
     *
     * @param $id
     * @return String
     */
    public function get($sample)
    {
        return $this->sampleRepository->get($sample);
    }


    /**
     * Validate sample data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function storeData($data)
    {
        return $this->sampleRepository->store($data);
    }


    /**
     * Update sample data
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function updateData($request, $sample)
    {
        return $this->sampleRepository->update($request, $sample);
    }


    /**
     * Delete sample by id.
     *
     * @param $id
     * @return String
     */
    public function delete($sample)
    {
        return $this->sampleRepository->delete($sample);
    }

}