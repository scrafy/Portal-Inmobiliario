<?php

namespace App\BussinesModel\Interfaces\ExternalApi\MainOperations;

interface IExternalApiMainDiaryOperations {

    public function getAllocations($offset = 0, $count = 100);

    public function getAllocation($allocationid);

    public function getAppointments($offset = 0, $count = 100);

    public function getAppointment($appointmentid);

    public function getAppointmentTypes($offset = 0, $count = 100);

    public function getAppointmentType($appointmentid);
}
