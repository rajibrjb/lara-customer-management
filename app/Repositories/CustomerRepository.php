<?php

namespace App\Repositories;

use App\Models\Customer;

class CustomerRepository
{
    /**
     * @var Customer
     */
    protected $customer;

    /**
     * CustomerRepository constructor.
     *
     * @param Customer $customer
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Get all customers.
     *
     * @return Customer $customer
     */
    public function getAll()
    {
        return $this->customer
            ->get();
    }

    /**
     * Get customer by id
     *
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->customer
            ->where('id', $id)
            ->get();
    }

    /**
     * Save Customer
     *
     * @param $data
     * @return Customer
     */
    public function save($data)
    {
        $customer = new $this->customer;

        $customer->title = $data['title'];
        $customer->description = $data['description'];

        $customer->save();

        return $customer->fresh();
    }

    /**
     * Update Customer
     *
     * @param $data
     * @return Customer
     */
    public function update($data, $id)
    {
        $customer = $this->customer->find($id);

        $customer->title = $data['title'];
        $customer->description = $data['description'];

        $customer->update();

        return $customer;
    }

    /**
     * Update Customer
     *
     * @param $data
     * @return Customer
     */
    public function delete($id)
    {

        $customer = $this->customer->find($id);
        $customer->delete();

        return $customer;
    }

}
