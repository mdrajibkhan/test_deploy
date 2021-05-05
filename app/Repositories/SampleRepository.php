<?php 

namespace App\Repositories;

use App\Models\Sample;
use Illuminate\Support\Facades\Config;

class SampleRepository
{
    /**
     * @var Sample
     */
    protected $sample;

    /**
     * SampleRepository constructor.
     *
     * @param Sample $sample
     */
    public function __construct(Sample $sample)
    {
        $this->sample = $sample;
    }

    /**
     * Get all samples.
     *
     * @return Sample $sample
     */
    public function getAll()
    {
        return $this->sample->latest()->paginate(Config::get('constants.paginate'));
    }

    /**
     * Get sample by id
     *
     * @param $id
     * @return mixed
     */
    public function get($sample)
    {
        return $sample;
    }

    /**
     * Save Sample
     *
     * @param $data
     * @return Sample
     */
    public function store($request)
    {
        // $sample = new $this->sample;

        // $sample->name = $request['name'];
        // $sample->detail = $request['detail'];
        // $sample->save();

        // OR 
        $sample = Sample::create($request->all());
        return $sample;
    }

    /**
     * Update Sample
     *
     * @param $data
     * @return Sample
     */
    public function update($request, $sample)
    {
        
        //$sample = $this->sample->find($id);
        // $sample->title = $request['title'];
        // $sample->description = $request['description'];
        // $sample->update();

        //OR 
        $sample->update($request->all());
        return $sample;
    }

    /**
     * Update Sample
     *
     * @param $data
     * @return Sample
     */
    public function delete($sample)
    {
        $sample->delete();
        return $sample;
    }

}
