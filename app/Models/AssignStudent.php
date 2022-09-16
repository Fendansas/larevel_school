<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AssignStudent
 * @package App\Models
 *
 * bigint $id
 * int $student_id
 * int $class_id
 * int $year_id
 * int $group_id
 * int $shift_id
 * timestamp $created_at
 * timestamp $updated_at
 *
 */
class AssignStudent extends Model
{
    use HasFactory;

    public function student(){
        return $this->belongsTo(User::class,'student_id', 'id');
    }

    public function discount(){
        return $this->belongsTo(DiscountStudent::class,'id', 'assign_student_id');
    }

    public function student_class(){
        return $this->belongsTo(StudentClass::class,'class_id', 'id');
    }

    public function student_year(){
        return $this->belongsTo(StudentYear::class,'year_id', 'id');
    }

    public function group(){
        return $this->belongsTo(StudentGroup::class,'group_id', 'id');
    }

    public function shift(){
        return $this->belongsTo(StudentShift::class,'shift_id', 'id');
    }


//    /**
//     * @return null
//     */
//    public function getStudentId()
//    {
//        return $this->student_id;
//    }
//
//    /**
//     * @param null $student_id
//     */
//    public function setStudentId($student_id): void
//    {
//        $this->student_id = $student_id;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getId()
//    {
//        return $this->id;
//    }
//
//    /**
//     * @param mixed $id
//     */
//    public function setId($id): void
//    {
//        $this->id = $id;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getClassId()
//    {
//        return $this->class_id;
//    }
//
//    /**
//     * @param mixed $class_id
//     */
//    public function setClassId($class_id): void
//    {
//        $this->class_id = $class_id;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getYearId()
//    {
//        return $this->year_id;
//    }
//
//    /**
//     * @param mixed $year_id
//     */
//    public function setYearId($year_id): void
//    {
//        $this->year_id = $year_id;
//    }
//
//    /**
//     * @return null
//     */
//    public function getGroupId()
//    {
//        return $this->group_id;
//    }
//
//    /**
//     * @param null $group_id
//     */
//    public function setGroupId($group_id): void
//    {
//        $this->group_id = $group_id;
//    }
//
//    /**
//     * @return null
//     */
//    public function getShiftId()
//    {
//        return $this->shift_id;
//    }
//
//    /**
//     * @param null $shift_id
//     */
//    public function setShiftId($shift_id): void
//    {
//        $this->shift_id = $shift_id;
//    }

//
//
//    /**
//     * @var
//     */
//    public $id;
//    /**
//     * @var
//     * integer
//     */
//    public $student_id = null;
//    /**
//     * @var
//     * integer
//     */
//    public $class_id;
//    /**
//     * @var
//     * integer
//     */
//    public $year_id;
//    /**
//     * @var null
//     * integer
//     */
//    public $group_id = null;
//    /**
//     * @var null
//     * integer
//     */
//    public $shift_id = null;




}
