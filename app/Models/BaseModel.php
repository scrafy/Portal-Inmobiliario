<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;
use ReflectionClass;
use ReflectionProperty;

abstract class BaseModel extends Model {

    private $errors = [];
    protected $validator = null;
    private $validation_errors = null;

    function __construct(array $attributes = []) {
        parent::__construct($attributes);
    }

    protected function setKeysForSaveQuery(\Illuminate\Database\Eloquent\Builder $query) {
        if (is_array($this->primaryKey)) {
            foreach ($this->primaryKey as $pk) {
                $query->where($pk, '=', $this->original[$pk]);
            }
            return $query;
        } else {
            return parent::setKeysForSaveQuery($query);
        }
    }

    public function SetAttributes() {
        $rc = new \ReflectionClass($this);
        $matches = [];
        $insert = [];
        foreach ($rc->getProperties() as &$property) {
            if ($property->class === get_class($this) && $property->isPublic()) {
                if (preg_match("/(forinsert)/", $property->getDocComment(), $matches)) {
                    if ($matches[1] === "forinsert") {
                        $insert[$property->getName()] = $property->getValue($this);
                    }
                }
            }
        }
        $this->setRawAttributes($insert);
        return $this;
    }

    public function Validate() {
        $objects_graph = [];
        self::extractObjects($this, $objects_graph);
        self::setValidators($objects_graph);
        $validation_errors = [];
        foreach ($objects_graph as &$object) {

            $rc = new ReflectionClass($object);
            $errors = $object->validator->errors()->toArray();
            foreach ($errors as $key => $value) {

                foreach ($value as $fieldname => $error) {

                    //$validation_errors[$rc->getShortName()][$key] = $error;
                    $validation_errors[$key] = $error;
                }
            }
        }
        $this->validation_errors = $validation_errors;
        if (count($this->validation_errors) > 0) {

            return false;
        }
        return true;
    }

    public function getValidationErrors() {
        return $this->validation_errors;
    }

    private static function setValidators(&$objects_graph = []) {
        $properties = [];
        foreach ($objects_graph as &$object) {

            $rc = new ReflectionClass($object);
            foreach ($rc->getProperties(ReflectionProperty::IS_PUBLIC) as $reflec_property) {

                if ($reflec_property->class === $rc->name) {

                    $value = $reflec_property->getvalue($object);
                    if (!is_object($value)) {

                        $properties[$reflec_property->name] = $value;
                    }
                }
            }
            $object->validator = Validator::make($properties, $object->validation_rules);
            $properties = [];
        }
    }

    private static function extractObjects($me, &$objects_graph = []) {
        $rc = new ReflectionClass($me);
        if ($rc->getName() != "stdClass") {
            array_push($objects_graph, $me);
        }
        foreach ($me as $value) {
            if (is_object($value)) {
                self::extractObjects($value, $objects_graph);
            } else if (is_array($value)) {
                self::extractObjects((object) $value, $objects_graph);
            }
        }
    }

}
