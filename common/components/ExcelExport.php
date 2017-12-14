<?php
namespace common\components;
use Yii;
/**
 * excel导出
 *
 * @copyright  2012 mwg0304@163.com
 * @author	   mwg
 * @createdate 2012-07-23
 * @version    $Id$
 */
class ExcelExport
{
	private $cells = null;
	private $seq = 0;
	private $charset = 'gb2312';
	private $font = '宋体';
	private $objExcel;
	private $objWriter;
	private $objActSheet;

	public function __construct($title, $charset = 'gb2312')
	{
		//Yii::$enableIncludePath=false;//静用Yii自身的自动加载方法
        require(Yii::getAlias("@common")."/components/excel/PHPExcel.php");
        require(Yii::getAlias("@common")."/components/excel/PHPExcel/Writer/Excel2007.php");
        $this->objExcel = new \PHPExcel();
		$this->objWriter = new \PHPExcel_Writer_Excel5($this->objExcel);//非2007格式
		//$this->objWriter = new PHPExcel_Writer_Excel2007($objExcel);//2007格式
		//$this->objWriter->setOffice2003Compatibility(true);
		$this->objExcel->setActiveSheetIndex(0);

		$this->objActSheet = $this->objExcel->getActiveSheet();

		//设置当前活动sheet的名称
		$this->objActSheet->setTitle($title);

		if($charset != '')
		{
			$this->charset = $charset;
		}
		$outputFileName = iconv("UTF-8", $this->charset, $title.".xls");
		//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');//2007格式
		//header('Content-Type: application/vnd.ms-excel');//非2007格式
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");
		header('Content-Disposition:inline;filename="'.$outputFileName.'"');
		header("Content-Transfer-Encoding: binary");
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Pragma: no-cache");
	}

	public function setCells($col_arr)
	{

		$this->seq++;
		$k = 0;//列序号
		foreach($col_arr as $c=>$cell)
		{
			$f1 = floor($k/26);
			$col1 = '';
			if($f1>0){
				$col1 = chr(64+$f1);
			}
			$f2 = $k%26;
			$col2 = chr(65+$f2);

            $objStyle = $this->objActSheet->getStyle("$col1$col2$this->seq");

			if($cell['val']!==null){

                switch($cell['val']){

                    case 'text':

                        $this->objActSheet->setCellValueExplicit("$col1$col2$this->seq",$cell['val'], \PHPExcel_Cell_DataType::TYPE_STRING);
                        break;
                    case 'number':

                        $this->objActSheet->setCellValue("$col1$col2$this->seq", $cell['val']);
                        $objFormat = $objStyle->getNumberFormat();
                        $objFormat->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
                        break;
					case 'date':

						$this->objActSheet->setCellValue("$col1$col2$this->seq", $cell['val']);
						$objFormat = $objStyle->getNumberFormat();
						$objFormat->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD2);
						break;
                    default:

                        $this->objActSheet->setCellValue("$col1$col2$this->seq", $cell['val']);
                        break;
                }

			}

			//位置设置
			if(!empty($cell['align'])){
				$objAlign = $objStyle->getAlignment();
				switch($cell['align']){
					case 'left':
						$objAlign->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						break;
					case 'center':
						$objAlign->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						break;
					case 'right':
						$objAlign->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						break;
					default:
						$objAlign->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						break;
				}
				//$objActSheet->getColumnDimension("$col1$col2")->setAutoSize(true);
			}
			//字体设置
			if(!empty($cell['font-size'])){
				$font = !empty($cell['font']) ? $cell['font'] : $this->font;
				$objFont = $objStyle->getFont();
				$objFont->setName($font);
				$objFont->setSize($cell['font-size']);
			}
			//宽度设置
			if(!empty($cell['width'])){
				$this->objActSheet->getColumnDimension("$col1$col2")->setWidth($cell['width']);
			}
			//列合并
			if(!empty($cell['colspan'])){
				$_k = $k+$cell['colspan']-1;
				$_f1 = floor($_k/26);
				$_col1 = '';
				if($_f1>0){
					$_col1 = chr(64+$_f1);
				}
				$_f2 = $_k%26;
				$_col2 = chr(65+$_f2);
				$this->objActSheet->mergeCells("$col1$col2$this->seq:$_col1$_col2$this->seq");
				$k = $_k;
			}
			//行合并
			if(!empty($cell['rowspan'])){
				$seq_next = $this->seq+$cell['rowspan']-1;
				$this->objActSheet->mergeCells("$col1$col2$this->seq:$col1$col2$seq_next");
				
			}
			$k++;
		}

	}

	public function save()
	{
		$this->objWriter->save('php://output');
	}
}
?>