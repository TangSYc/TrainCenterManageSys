<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class TeachingInspectionInfo extends Model
{
    protected $table = "teaching_inspection_info";
    public $timestamps = true;
    protected $guarded = [];
<<<<<<< HEAD


    /**
     * 期末教学记录检查表页面查看
     * @author ChenMiao <github.com/Yidaaa-u>
     * @param String $form_id
     * form_id 表单编号
     * @return array
     */
    public static function cm_teaRecordDisplayInfo($form_id){
        try {
            $data1=self::join('laboratory','teaching_inspection_info.laboratory_id','laboratory.laboratory_id')
                ->select('teaching_inspection_info.laboratory_id',
                    'laboratory.laboratory_name',
                    'teaching_inspection_info.class_name',
                    'teaching_inspection_info.teacher',
                    'teaching_inspection_info.teach_operating_condition',
                    'teaching_inspection_info.operating_condition',
                    'teaching_inspection_info.remark')
                ->where('teaching_inspection_info.form_id',$form_id)
                ->get();
            $data2=Form::cmm_teaRecordDisplayInfo($form_id);
            $data['forminfo']=$data1;
            $data['reocrd_info']=$data2;
            return $data;
        }catch (\Exception $e){
            logError('获取开放实验室申请表信息错误',[$e->getMessage()]);
            return null;
        }
    }


=======
>>>>>>> 1dfbae9f76267b4bcbe3dad1484943137416b2b9
    /*
    * 展示id对应的表单
    * @author caiwenpin <github.com/codercwp>
    * @param $id
    * return result
    */
    public static function cwp_show($id){
        try {
            $data = self::where('form_id', $id)->select('laboratory_id','class_name','teacher','teach_operating_condition','operating_condition','remark')->get();

            return $data;
        } catch (\Exception $e) {
            logError('找不到相同表单编号', [$e->getMessage()]);
        }
    }


    /*
    * 展示id对应的实验室与表单信息
    * @author caiwenpin <github.com/codercwp>
    * @param $id
    * return result
    */
    public static function cwp_one($id){
        try {
            $data = self::join('laboratory','teaching_inspection_info.laboratory_id','laboratory.laboratory_id')
                ->where('teaching_inspection_info.laboratory_id',$id)

                ->select('laboratory.laboratory_name','teaching_inspection_info.laboratory_id',
                    'teaching_inspection_info.class_name','teaching_inspection_info.teacher',
                    'teaching_inspection_info.teach_operating_condition',
                    'teaching_inspection_info.operating_condition',
                    'teaching_inspection_info.remark')
                ->get();
            return $data;
        } catch (\Exception $e) {
            logError('展示错误', [$e->getMessage()]);
        }
    }

    /*
    * 将数据存入数据库
    * @author caiwenpin <github.com/codercwp>
    * @param $id，$data
    * return result
    */

    public static function cwp_add($id, $data){
        try {
            for($i=0;$i<count($data);$i++) {
                $result = self::create([
                    'form_id' => $id,
                    'laboratory_id' => $data[$i]['laboratory_id'],
                    'class_name' => $data[$i]['class_name'],
                    'teacher' => $data[$i]['teacher'],
                    'teach_operating_condition' => $data[$i]['teach_operating_condition'],
                    'operating_condition' => $data[$i]['operating_condition'],
                    'remark' => $data[$i]['remark'],
                ]);
            }
            return $result;
        } catch (\Exception $e) {
            logError('增加错误', [$e->getMessage()]);
        }
    }

        }
    }

    /**
     * 安全检查情况
     * @author yuanshuxin <github.com/CoderYsx>
     * @return \Illuminate\Http\JsonResponse
     */
    public static function ysx_safecheck(){

        try {
            $res = DB::table('teaching_inspection_info')
                ->join('laboratory', 'laboratory.laboratory_id', '=', 'teaching_inspection_info.laboratory_id')
                ->select('laboratory.laboratory_name')->get();
            return $res;
        } catch (\Exception $e) {
            logError('失败',[$e->getMessage()]);
            return null;
        }

    }

    /**
     * 数量统计
     * @author yuanshuxin <github.com/CoderYsx>
     * @return \Illuminate\Http\JsonResponse
     */
    public static function ysx_checkcount(){
        try {
            $res = DB::table('chview')->get();
            return $res;
        } catch (\Exception $e) {
            logError('失败',[$e->getMessage()]);
            return null;
        }
    }

    /**
     * 检查统计
     * @author yuanshuxin <github.com/CoderYsx>
     * @return \Illuminate\Http\JsonResponse
     */
    public static function ysx_checkStatistics(){
        try {
            $res = DB::table('chstatistics')->get();
            return $res;
        } catch (\Exception $e) {
            logError('失败',[$e->getMessage()]);
            return null;
        }
    }

}
