<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\search\CarritoSearch;
use app\models\SoldCorreo;
use app\models\search\SoldCorreoSearch;
use app\models\search\ExcelSearch;
use app\models\search\VistasSearch;
use app\models\search\VentasGeneroSearch;
use app\models\Carrito;
//use PHPExcel\Style_Alignment;

/**
 * Site controller
 */
class EstadisticasController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view','enviado', 'excel'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new CarritoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $vistasSearch = new VistasSearch();
        $vistasProvider = $vistasSearch->search(Yii::$app->request->queryParams);
        $ventasGeneroSearch = new VentasGeneroSearch();
        $ventasGeneroProvider = $ventasGeneroSearch->search(Yii::$app->request->queryParams);
        $soldSearch = new SoldCorreoSearch();
        $soldProvider = $soldSearch->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'soldSearch' => $soldSearch,
            'soldProvider' => $soldProvider,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'vistasSearch' => $vistasSearch,
            'vistasProvider' => $vistasProvider,
            'ventasGeneroSearch' => $ventasGeneroSearch,
            'ventasGeneroProvider' => $ventasGeneroProvider,
        ]);
    }

    public function actionView($id) {
        $carrito = Carrito::findOne($id);
        return $this->render('view', [
            'carrito' => $carrito
        ]);
    }
    
    public function actionExcel(){
        $excelSearch = new ExcelSearch();
        $excelSearch->fecha_inicio = strtotime($_POST['VistasExcel']['fecha_inicio']);
        $excelSearch->fecha_final = (strtotime($_POST['VistasExcel']['fecha_final']))+86400;
        $productos = $excelSearch->search(Yii::$app->request->queryParams);
        $objPHPExcel = new \PHPExcel();
        $sheet=0;
        $objPHPExcel->setActiveSheetIndex($sheet);
//        $style = array(
//            'alignment' => array(
//                'horizontal' => PHPExcel\Style_Alignment::HORIZONTAL_CENTER, //no funcionan los estilos
//            )
//        );

        
//        $objDrawing = new \PHPExcel_Worksheet_Drawing();    //create object for Worksheet drawing
//        $objDrawing->setName('VocaMX Logo');        //set name to image
//        $objDrawing->setDescription('VocaMX Logo'); //set description to image 
//        $objDrawing->setPath('../web/images/logo-excel.png');           //Path to signature .jpg file
//        $objDrawing->setOffsetX(10);                       //setOffsetX works properly
//        $objDrawing->setOffsetY(10);                       //setOffsetY works properly
//        $objDrawing->setCoordinates('A5');        //set image to cell
//        $objDrawing->setWidth(30);                 //set width, height
//        $objDrawing->setHeight(44);  
//        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());  //save
          
        for ($i = 1; $i < count($productos)+12; $i++){          //formato de alto de celdas
            $objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(15);
        }
        for ($i = 12; $i < count($productos)+12; $i++){         //formula de usuarios no registrados
            $objPHPExcel->getActiveSheet()->setCellValue('G'.$i,'=SUM(E'.$i.':F'.$i.')');
        }
        $objPHPExcel->getActiveSheet()->getRowDimension(5)->setRowHeight(35);
        $objPHPExcel->getActiveSheet()->getRowDimension(10)->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->mergeCells('B5:H5');
        //$objPHPExcel->getStyle("B5")->applyFromArray($style); //esta parte no funciona
        
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);//formato de ancho de celdas
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(16);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(14);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(14);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(7);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(11);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(11);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10); 
        
//        $objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $objPHPExcel->getActiveSheet()->setCellValue('B5','ESTADISTICAS');
        $objPHPExcel->getActiveSheet()->setCellValue('A10','Modelo');       //cabeceras de tabla
        $objPHPExcel->getActiveSheet()->setCellValue('B10','Tiempo Acumulado');
        $objPHPExcel->getActiveSheet()->setCellValue('C10','Tiempo por Día');
        $objPHPExcel->getActiveSheet()->setCellValue('D10','Genero Bomber');
        $objPHPExcel->getActiveSheet()->setCellValue('E10','Visitas');
        $objPHPExcel->getActiveSheet()->setCellValue('F10','Con Usuario');
        $objPHPExcel->getActiveSheet()->setCellValue('G10','Sin Usuario');
        $objPHPExcel->getActiveSheet()->setCellValue('H10','Checkouts');
        
        $objPHPExcel->getActiveSheet() //se ingresan los datos desde el array del modelo
            ->fromArray(
                $productos,  // The data to set
                NULL,        // Array values with this value will not be set
                'A12'         // Top left coordinate of the worksheet range where
            );
        
        ob_end_clean(); //Esto hace que no salgan caracteres raros en el excel
        header('Content-Type: application/vnd.ms-excel'); //de aqui en adelante son datos del archivo
        $filename = "Estadisticas_".date("d-m-Y-His").".xls";
        header('Content-Disposition: attachment;filename='.$filename .' ');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }
}
