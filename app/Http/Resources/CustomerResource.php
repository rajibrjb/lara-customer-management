<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\OrganisationResource;

class CustomerResource extends JsonResource
{
    private $fields;
    private $return_fields;

    public function __construct($resource, $fields = [])
    {
        // Ensure we call the parent constructor
        parent::__construct($resource);

        $this->resource = $resource;
        $this->fields = $fields;
        $this->return_fields[] = 'id';
    }

    public static function collection($resource, $fields = [])
    {
        //wrap each item in collection with single resource
        return tap($resource, function ($collection) use ($fields) {
            foreach ($collection as $k => $item) {
                $collection[$k] = new CustomerResource($item, $fields);
            }
        });
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return collect([
            'id' => $this->id,
            'first_name' => $this->inArrayOrKey('first_name') ? $this->first_name : null,
            'last_name' => $this->inArrayOrKey('last_name') ? $this->last_name : null,
            'date_of_birth' => $this->inArrayOrKey('date_of_birth') ? $this->date_of_birth : null,
            'title' => $this->inArrayOrKey('title') ? $this->title : null,
            'state' => $this->inArrayOrKey('state') ? $this->state : null,
            'phone' => $this->inArrayOrKey('phone') ? $this->phone : null,
            'email' => $this->inArrayOrKey('email') ? $this->email : null
        ])->only($this->return_fields);
    }

    public function inArrayOrKey($field)
    {
        if (is_array($this->fields) && (in_array($field, $this->fields) || array_key_exists($field, $this->fields))) {
            $this->return_fields[] = $field;
            return true;
        }

        return false;
    }
}
