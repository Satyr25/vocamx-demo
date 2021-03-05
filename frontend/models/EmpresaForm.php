<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * ContactForm is the model behind the contact form.
 */
class EmpresaForm extends Model
{
    public $nombre;
    public $email;
    public $telefono;
    public $donde;
    public $asunto;
    public $mensaje;
    public $archivo;

    public $tipo_alianza;
    public $fecha_proyecto;

    public $piezas;
    public $tipo_producto;
    public $fecha_produccion;

    public $tipo_tienda;
    public $puntos_venta;

    private $tipos_alianza = [
            0 => 'Edición Especial',
            1 => 'Desarrollo de Producto',
            2 => 'Merchandising de Marca',
            3 => 'Beneficiencia',
            4 => 'Colaboración Artística o PR'
        ];
    private $tipos_producto = [
        0 => 'Personalizado',
        1 => 'Línea'
    ];

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'email'], 'required'],
            [['nombre', 'telefono', 'donde', 'tipo_producto','asunto', 'piezas', 'mensaje','fecha_proyecto','fecha_produccion'], 'string'],
            [['archivo'], 'file'],
            ['email', 'email'],
            ['tipo_alianza', 'each', 'rule' => ['integer']],
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();
    }

    public function enviar($emailTo){
        $mensaje = "<b>Nombre: </b> ".$this->nombre.'<br>'.
            '<b>Correo: </b>'.$this->email.'<br>'.
            '<b>Teléfono: </b>'.$this->telefono.'<br>'.
            '<b>¿De donde es?: </b>'.$this->donde.'<br>';
        if($this->asunto == 'alianza'){
            $mensaje .= '<b>Asunto: </b> Alianza<br>'.
                '<b>Tipo de alianza: </b>';
                foreach($this->tipo_alianza as $i => $tipo){
                    $mensaje .= $this->tipos_alianza[$tipo].($i+1 < count($this->tipo_alianza) ? ' / ' : '');
                }
            $mensaje .= '<br><b>Fecha estimada de lanzamiento: </b>'.$this->fecha_proyecto;
        }else if($this->asunto == 'mayoreo'){
            $mensaje .= '<b>Asunto: </b>Mayoreo<br>'.
                '<b>Piezas: </b>'.$this->piezas.'<br>'.
                '<b>Tipo de producto: </b>'. $this->tipos_producto[$this->tipo_producto].
                '<br><b>Fecha de producción: </b>'. $this->fecha_produccion;
        }else if($this->asunto == 'distribucion'){
            $mensaje .= '<br><b>Asunto: </b>Distribución<br>'.
                '<b>Tipo de tienda: </b>'. $this->tipo_tienda.
                '<b>Puntos de venta: </b>'.$this->puntos_venta.'<br>';
        }
        $mensaje .= '<b>Mensaje: </b><br>'.$this->mensaje;

        $adjunto = UploadedFile::getInstances($this, 'archivo');
        if(count($adjunto)){
            $adjunto = $adjunto[0];
            $ruta = Yii::getAlias('@frontend/web/uploads/');
            $nombre_archivo = $timestamp.preg_replace("/[^a-z0-9\.]/", "", strtolower($adjunto->name));
            $adjunto->saveAs($ruta.'/'.$nombre_archivo);
        }

        $mailer = Yii::$app->mailer->compose()
            ->setTo($emailTo)
            ->setFrom([$this->email => $this->nombre])
            ->setSubject('Contacto Empresa')
            ->setHtmlBody($mensaje);

        if($adjunto){
            $mailer->attach($ruta.'/'.$nombre_archivo);
        }

        return $mailer->send();
    }
}
