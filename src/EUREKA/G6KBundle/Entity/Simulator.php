<?php

namespace EUREKA\G6KBundle\Entity;

class Simulator {

	private $controller = "";
	private $name = "";
	private $label = "";
	private $dynamic = false;
	private $description = "";
	private $dateFormat = "";
	private $decimalPoint = "";
	private $moneySymbol = "";
	private $symbolPosition = "";
	private $globalConstraints = array();
	private $groupConstraints = array();
	private $datas = array();
	private $steps = array();
	private $sites = array();
	private $databases = array();
	private $datasources = array();
	private $sources = array();
	private $dependencies = "";
	private $error = false;
	private $errorMessages = array();
	
	public function __construct($controller) {
		$this->controller = $controller;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function setName($name) {
		$this->name = $name;
	}
	
	public function getLabel() {
		return $this->label;
	}
	
	public function setLabel($label) {
		$this->label = $label;
	}
	
	public function isDynamic() {
		return $this->dynamic;
	}
	
	public function setDynamic($dynamic) {
		$this->dynamic = $dynamic;
	}
	
	public function getDescription() {
		return $this->description;
	}
	
	public function setDescription($description) {
		$this->description = $description;
	}
	
	public function getDateFormat() {
		return $this->dateFormat;
	}
	
	public function setDateFormat($dateFormat) {
		$this->dateFormat = $dateFormat;
	}
	
	public function getDecimalPoint() {
		return $this->decimalPoint;
	}
	
	public function setDecimalPoint($decimalPoint) {
		$this->decimalPoint = $decimalPoint;
	}
	
	public function getMoneySymbol() {
		return $this->moneySymbol;
	}
	
	public function setMoneySymbol($moneySymbol) {
		$this->moneySymbol = $moneySymbol;
	}
	
	public function getSymbolPosition() {
		return $this->symbolPosition;
	}
	
	public function setSymbolPosition($symbolPosition) {
		$this->symbolPosition = $symbolPosition;
	}
	
	public function getGlobalConstraints() {
		return $this->globalConstraints;
	}
	
	public function setGlobalConstraints($globalConstraints) {
		$this->globalConstraints = $globalConstraints;
	}
	
	public function addGlobalConstraint(Constraint $globalConstraint) {
		$this->globalConstraints[] = $globalConstraint;
	}
	
	public function removeGlobalConstraint($index) {
		$this->globalConstraints[$index] = null;
	}
	
	public function getGroupConstraints() {
		return $this->groupConstraints;
	}
	
	public function setGroupConstraints($groupConstraints) {
		$this->groupConstraints = $groupConstraints;
	}
	
	public function addGroupConstraint(Constraint $groupConstraint) {
		$this->groupConstraints[] = $groupConstraint;
	}
	
	public function removeGroupConstraint($index) {
		$this->groupConstraints[$index] = null;
	}

	public function getDatas() {
		return $this->datas;
	}
	
	public function setDatas($datas) {
		$this->datas = $datas;
	}
	
	public function addData($data) {
		$this->datas[] = $data;
	}
	
	public function removeData($index) {
		$this->datas[$index] = null;
	}
	
	public function getDataById($id) {
		foreach ($this->datas as $data) {
			if ($data instanceof DataGroup) {
				if (($gdata = $data->getDataById($id)) !== null) {
					return $gdata;
				}
			} elseif ($data->getId() == $id) {
				return $data;
			}
		}
		return null;
	}
	
	public function getDataByName($name) {
		foreach ($this->datas as $data) {
			if ($data instanceof DataGroup) {
				if (($gdata = $data->getDataByName($name)) !== null) {
					return $gdata;
				}
			} elseif ($data->getName() == $name) {
				return $data;
			}
		}
		return null;
	}
	
	public function getDataGroupById($id) {
		foreach ($this->datas as $data) {
			if (($data instanceof DataGroup) && $data->getId() == $id) {
				return $data;
			}
		}
		return null;
	}
	
	public function getDataGroupByName($name) {
		foreach ($this->datas as $data) {
			if (($data instanceof DataGroup) && $data->getName() == $name) {
				return $data;
			}
		}
		return null;
	}
	
	public function getSteps() {
		return $this->steps;
	}
	
	public function setSteps($steps) {
		$this->steps = $steps;
	}
	
	public function addStep(Step $step) {
		$this->steps[] = $step;
	}
	
	public function removeStep($index) {
		$this->steps[$index] = null;
	}
	
	public function getStepById($id) {
		foreach ($this->steps as $step) {
			if ($step->getId() == $id) {
				return $step;
			}
		}
		return null;
	}
	
	public function getSources() {
		return $this->sources;
	}
	
	public function setSources($sources) {
		$this->sources = $sources;
	}
	
	public function addSource(Source $source) {
		$this->sources[] = $source;
	}
	
	public function removeSource($index) {
		$this->sources[$index] = null;
	}
	
	public function getSiteById($id) {
		foreach ($this->sites as $site) {
			if ($site->getId() == $id) {
				return $site;
			}
		}
		return null;
	}
	
	public function getDatabaseById($id) {
		foreach ($this->databases as $database) {
			if ($database->getId() == $id) {
				return $database;
			}
		}
		return null;
	}
	
	public function getDatasourceById($id) {
		foreach ($this->datasources as $datasource) {
			if ($datasource->getId() == $id) {
				return $datasource;
			}
		}
		return null;
	}
	
	public function getSourceById($id) {
		foreach ($this->sources as $source) {
			if ($source->getId() == $id) {
				return $source;
			}
		}
		return null;
	}
	
	public function isError() {
		return $this->error;
	}
	
	public function setError($error) {
		$this->error = $error;
	}
	
	public function getErrorMessages() {
		return $this->errorMessages;
	}
	
	public function setErrorMessages($errorMessages) {
		$this->errorMessages = $errorMessages;
	}
	
	public function addErrorMessage($errorMessage) {
		$this->errorMessages[] = $errorMessage;
	}
	
	public function removeErrorMessage($index) {
		$this->errorMessages[$index] = null;
	}
	
	protected function loadData($data) {
		$dataObj = new Data($this, (int)$data['id'], (string)$data['name']);
		$dataObj->setLabel((string)$data['label']);
		$dataObj->setType((string)$data['type']);
		$dataObj->setUnparsedMin((string)$data['min']);
		$dataObj->setUnparsedMax((string)$data['max']);
		$dataObj->setUnparsedDefault((string)$data['default']);
		$dataObj->setUnit((string)$data['unit']);
		$dataObj->setRound(isset($data['round']) ? (int)$data['round'] : 2);
		$dataObj->setContent((string)$data['content']);
		$dataObj->setSource((string)$data['source']);
		$dataObj->setUnparsedIndex((string)$data['index']);
		if ($data->Choices) {
			foreach ($data->Choices->Choice as $choice) {
				$choiceObj = new Choice($dataObj, (string)$choice['id'], (string)$choice['value'], (string)$choice['label']);
				$choiceObj->setCondition((string)$choice['condition']);
				$dataObj->addChoice($choiceObj);
			}
			if ($data->Choices->Source) {
				$source = $data->Choices->Source;
				$choiceSourceObj = new ChoiceSource($dataObj, (int)$source['id'], (string)$source['valueColumn'], (string)$source['labelColumn']);
				$choiceSourceObj->setIdColumn((string)$source['idColumn']);
				$dataObj->setChoiceSource($choiceSourceObj);
			}
		}
		if ($data->Table) {
			$table = $data->Table;
			$tableObj = new Table($dataObj, (string)$table['id']);
			$tableObj->setName((string)$table['name']);
			$tableObj->setLabel((string)$table['label']);
			$tableObj->setDescription($table->Description);
			foreach ($table->Column as $column) {
				$columnObj = new Column($tableObj, (int)$column['id'], (string)$column['name'], (string)$column['type']);
				$columnObj->setLabel((string)$column['label']);
				$columnObj->setCondition((string)$column['condition']);
				$tableObj->addColumn($columnObj);
			}
			$dataObj->setTable($tableObj);
		}
		if ($data->Constraints) {
			foreach ($data->Constraints->Constraint as $constraint) {
				$constraintObj = new Constraint((int)$constraint['id'], (string)$constraint['constraint'], (string)$constraint['constraintMessage']);
				$dataObj->addConstraint($constraintObj);
			}
		}
		$dataObj->setDescription($data->Description);
		return $dataObj;
	}
	
	public function load($url) {
		$simulator = new \SimpleXMLElement($url, LIBXML_NOWARNING, true);
		$datasources = new \SimpleXMLElement(dirname(dirname(__FILE__)).'/Resources/data/databases/DataSources.xml', LIBXML_NOWARNING, true);
		foreach ($datasources->DataSource as $datasource) {
			$datasourceObj = new DataSource($this, (int)$datasource['id'], (string)$datasource['name'], (string)$datasource['type']);
			$datasourceObj->setUri((string)$datasource['uri']);
			$datasourceObj->setDatabase((int)$datasource['database']);
			$datasourceObj->setDescription($datasource->Description);
			$this->datasources[] = $datasourceObj;
		}
		if ($datasources->Databases) {
			foreach ($datasources->Databases->Database as $database) {
				$databaseObj = new Database($this, (int)$database['id'], (string)$database['type'], (string)$database['name']);
				$databaseObj->setLabel((string)$database['label']);
				$databaseObj->setHost((string)$database['host']);
				$databaseObj->setPort((int)$database['port']);
				$databaseObj->setUser((string)$database['user']);
				$databaseObj->setPassword((string)$database['password']);
				$this->databases[] = $databaseObj;
			}
		}
		$this->setName((string)$simulator["name"]);
		$this->setLabel((string)$simulator["label"]);
		$this->setDynamic((string)$simulator['dynamic'] == '1');
		$this->setDescription($simulator->Description);
		$this->setDateFormat((string)($simulator->DataSet['dateFormat']));
		$this->setDecimalPoint((string)($simulator->DataSet['decimalPoint']));
		$this->setMoneySymbol((string)($simulator->DataSet['moneySymbol']));
		$this->setSymbolPosition((string)($simulator->DataSet['symbolPosition']));
		if ($simulator->DataSet) {
			foreach ($simulator->DataSet->children() as $child) {
				if ($child->getName() == "DataGroup") {
					$datagroup = $child;
					$dataGroupObj = new DataGroup($this, (int)$datagroup['id'], (string)$datagroup['name']);
					$dataGroupObj->setLabel((string)$datagroup['label']);
					if ($datagroup->Constraints) {
						foreach ($datagroup->Constraints->Constraint as $constraint) {
							$constraintObj = new Constraint((int)$constraint['id'], (string)$constraint['constraint'], (string)$constraint['constraintMessage']);
							$dataGroupObj->addConstraint($constraintObj);
						}
					}
					$dataGroupObj->setDescription($datagroup->Description);
					foreach ($datagroup->Data as $data) {
						$dataGroupObj->addData( $this->loadData($data));
					}
					$this->datas[] = $dataGroupObj;
				} elseif ($child->getName() == "Data") {
					$this->datas[] = $this->loadData($child);
				} elseif ($child->getName() == "GlobalConstraints") {
					foreach ($child->Constraint as $constraint) {
						$constraintObj = new Constraint((int)$constraint['id'], (string)$constraint['constraint'], (string)$constraint['constraintMessage']);
						$this->globalConstraints[] = $constraintObj;
					}
				}
			}
		}
		if ($simulator->Steps) {
			$step0 = false;
			foreach ($simulator->Steps->Step as $step) {
				$stepObj = new Step($this, (int)$step['id'], (string)$step['name'], (string)$step['label'], (string)$step['template']);
				if ($stepObj->getId() == 0) {
					$step0 = true;
				}
				$stepObj->setCondition((string)$step['condition']);
				$stepObj->setOutput((string)$step['output']);
				$stepObj->setDescription($step->Description);
				$stepObj->setDynamic((string)$step['dynamic'] == '1');
				foreach ($step->FieldSet as $fieldset) {
					$fieldsetObj = new FieldSet($stepObj, (int)$fieldset['id']);
					$fieldsetObj->setLegend($fieldset->Legend);
					$fieldsetObj->setCondition((string)$fieldset['condition']);
					if ((string)$fieldset['disposition'] != "") {
						$fieldsetObj->setDisposition((string)$fieldset['disposition']);
					}
					foreach ($fieldset->children() as $child) {
						if ($child->getName() == "Columns") {
							foreach ($child->Column as $column) {
								$columnObj = new Column(null, (int)$column['id'], (string)$column['name'], (string)$column['type']);
								$columnObj->setLabel((string)$column['label']);	
								$fieldsetObj->addColumn($columnObj);
							}
						} elseif ($child->getName() == "FieldRow") {
							$fieldrow = $child;
							$fieldRowObj = new FieldRow($fieldsetObj, (string)$fieldrow['label']);
							$fieldRowObj->setColon((string)$fieldrow['colon'] == '' || (string)$fieldrow['colon'] == '1');					
							$fieldRowObj->setHelp((string)$fieldrow['help'] == '1');					
							$fieldRowObj->setEmphasize((string)$fieldrow['emphasize'] == '1');					
							$fieldRowObj->setDataGroup((string)$fieldrow['datagroup']);					
							foreach ($fieldrow->Field as $field) {
								$fieldObj = new Field($fieldsetObj, (int)$field['position'], (int)$field['data'], (string)$field['label']);
								$fieldObj->setUsage((string)$field['usage']);
								$fieldObj->setPrompt((string)$field['prompt']);
								$fieldObj->setNewline((string)$field['newline'] == '' || (string)$field['newline'] == '1');					
								$fieldObj->setRequired((string)$field['required'] == '1');					
								$fieldObj->setColon((string)$field['colon'] == '' || (string)$field['colon'] == '1');					
								$fieldObj->setUnderlabel((string)$field['underlabel'] == '1');					
								$fieldObj->setHelp((string)$field['help'] == '1');					
								$fieldObj->setEmphasize((string)$field['emphasize'] == '1');					
								$fieldObj->setExplanation((string)$field['explanation']);
								$fieldObj->setCondition((string)$field['condition']);
								$fieldObj->setExpanded((string)$field['expanded'] == '1');
								if ($field->PreNote) {
									$noteObj = new FieldNote($this);
									$noteObj->setText($field->PreNote);
									$noteObj->setCondition((string)$field->PreNote['condition']);
									$fieldObj->setPreNote($noteObj);
								}
								if ($field->PostNote) {
									$noteObj = new FieldNote($this);
									$noteObj->setText($field->PostNote);
									$noteObj->setCondition((string)$field->PostNote['condition']);
									$fieldObj->setPostNote($noteObj);
								}
								$fieldRowObj->addField($fieldObj);
							}
							$fieldsetObj->addField($fieldRowObj);
						} elseif ($child->getName() == "Field") {						
							$field = $child;
							$fieldObj = new Field($fieldsetObj, (int)$field['position'], (int)$field['data'], (string)$field['label']);
							$fieldObj->setUsage((string)$field['usage']);
							$fieldObj->setPrompt((string)$field['prompt']);
							$fieldObj->setNewline((string)$field['newline'] == '' || (string)$field['newline'] == '1');					
							$fieldObj->setRequired((string)$field['required'] == '1');					
							$fieldObj->setColon((string)$field['colon'] == '' || (string)$field['colon'] == '1');					
							$fieldObj->setUnderlabel((string)$field['underlabel'] == '1');					
							$fieldObj->setHelp((string)$field['help'] == '1');					
							$fieldObj->setEmphasize((string)$field['emphasize'] == '1');					
							$fieldObj->setExplanation((string)$field['explanation']);
							$fieldObj->setCondition((string)$field['condition']);
							$fieldObj->setExpanded((string)$field['expanded'] == '1');					
							if ($field->PreNote) {
								$noteObj = new FieldNote($this);
								$noteObj->setText($field->PreNote);
								$noteObj->setCondition((string)$field->PreNote['condition']);
								$fieldObj->setPreNote($noteObj);
							}
							if ($field->PostNote) {
								$noteObj = new FieldNote($this);
								$noteObj->setText($field->PostNote);
								$noteObj->setCondition((string)$field->PostNote['condition']);
								$fieldObj->setPostNote($noteObj);
							}
							$fieldsetObj->addField($fieldObj);
						}
					}
					$stepObj->addFieldSet($fieldsetObj);
				}
				foreach ($step->ActionList as $actionList) {
					foreach ($actionList as $action) {
						$actionObj = new Action($stepObj, (string)$action['name'], (string)$action['label']);
						$actionObj->setCondition((string)$action['condition']);
						$actionObj->setClass((string)$action['class']);
						$actionObj->setWhat((string)$action['what']);
						$actionObj->setFor((string)$action['for']);
						$actionObj->setUri((string)$action['uri']);
						$stepObj->addAction($actionObj);
					}
				}
				foreach ($step->FootNotes as $footnotes) {
					$footnotesObj = new FootNotes($stepObj);
					if ((string)$footnotes['position'] != "") {
						$footnotesObj->setPosition((string)$footnotes['position']);
					}
					foreach ($footnotes as $footnote) {
						$footnoteObj = new FootNote($stepObj, (int)$footnote['id']);
						$footnoteObj->setCondition((string)$footnote['condition']);
						$footnoteObj->setText($footnote);
						$footnotesObj->addFootNote($footnoteObj);
					}
					$stepObj->setFootNotes($footnotesObj);
				}
				$this->steps[] = $stepObj;
			}
			if (!$step0) {
				$this->setDynamic(false);
			}
		}
		if ($simulator->Sites) {
			foreach ($simulator->Sites->Site as $site) {
				$siteObj = new Site($this, (int)$site['id'], (string)$site['name'], (string)$site['home']);
				$this->sites[] = $siteObj;
			}
		}
		if ($simulator->Sources) {
			foreach ($simulator->Sources->Source as $source) {
				$sourceObj = new Source($this, (int)$source['id'], (int)$source['datasource'], (string)$source['returnType']);
				$sourceObj->setRequest((string)$source['request']);
				$sourceObj->setReturnPath((string)$source['returnPath']);
				foreach ($source->Parameter as $parameter) {
					$parameterObj = new Parameter($sourceObj, (string)$parameter['type']);
					$parameterObj->setName((string)$parameter['name']);
					$parameterObj->setFormat((string)$parameter['format']);
					$parameterObj->setData((int)$parameter['data']);
					$sourceObj->addParameter($parameterObj);
				}
				$this->sources[] = $sourceObj;
			}
		}
	}
	
	public function loadForSource($url) {
		$simulator = new \SimpleXMLElement($url, LIBXML_NOWARNING, true);
		$datasources = new \SimpleXMLElement(dirname(dirname(__FILE__)).'/Resources/data/databases/DataSources.xml', LIBXML_NOWARNING, true);
		foreach ($datasources->DataSource as $datasource) {
			$datasourceObj = new DataSource($this, (int)$datasource['id'], (string)$datasource['name'], (string)$datasource['type']);
			$datasourceObj->setUri((string)$datasource['uri']);
			$datasourceObj->setDatabase((int)$datasource['database']);
			$datasourceObj->setDescription($datasource->Description);
			$this->datasources[] = $datasourceObj;
		}
		if ($datasources->Databases) {
			foreach ($datasources->Databases->Database as $database) {
				$databaseObj = new Database($this, (int)$database['id'], (string)$database['type'], (string)$database['name']);
				$databaseObj->setLabel((string)$database['label']);
				$databaseObj->setHost((string)$database['host']);
				$databaseObj->setPort((int)$database['port']);
				$databaseObj->setUser((string)$database['user']);
				$databaseObj->setPassword((string)$database['password']);
				$this->databases[] = $databaseObj;
			}
		}
		if ($simulator->DataSet) {
			foreach ($simulator->DataSet->children() as $child) {
				if ($child->getName() == "DataGroup") {
					foreach ($child->Data as $data) {
						$dataObj = new Data($this, (int)$data['id'], (string)$data['name']);
						$dataObj->setLabel((string)$data['label']);
						$dataObj->setType((string)$data['type']);
						$this->datas[] = $dataObj;
					}
				} elseif ($child->getName() == "Data") {
					$dataObj = new Data($this, (int)$child['id'], (string)$child['name']);
					$dataObj->setLabel((string)$child['label']);
					$dataObj->setType((string)$child['type']);
					$this->datas[] = $dataObj;
				}
			}
		}
		if ($simulator->Sources) {
			foreach ($simulator->Sources->Source as $source) {
				$sourceObj = new Source($this, (int)$source['id'], (int)$source['datasource'], (string)$source['returnType']);
				$sourceObj->setRequest((string)$source['request']);
				$sourceObj->setReturnPath((string)$source['returnPath']);
				foreach ($source->Parameter as $parameter) {
					$parameterObj = new Parameter($sourceObj, (string)$parameter['type']);
					$parameterObj->setName((string)$parameter['name']);
					$parameterObj->setFormat((string)$parameter['format']);
					$parameterObj->setData((int)$parameter['data']);
					$sourceObj->addParameter($parameterObj);
				}
				$this->sources[] = $sourceObj;
			}
		}
	}

	private function addDependency ($matches) {
		$id = $matches[1];
		$dependency = $this->name;
		if (! isset($this->datas[$id][$this->dependencies])) {
				$this->datas[$id][$this->dependencies] = array();
		}
		foreach ($this->datas[$id][$this->dependencies] as $d) {
			if ($d == $dependency) {
				return $this->datas[$id]['name'];
			}
		}
		$this->datas[$id][$this->dependencies][] = $dependency;
		return $this->datas[$id]['name'];
	}
	
	private function addNoteDependency ($matches) {
		return "#(".$this->addDependency ($matches).")";
	}
	
	private function replaceDataIdByName($matches) {
		$id = $matches[1];
		return $this->datas[$id] ? "#(" . $this->datas[$id]['name'] . ")" : "#" . $id;
	}
	
	private function replaceIdByName($target) {
		return preg_replace_callback(
			"/#(\d+)/", 
			array($this, 'replaceDataIdByName'),
			$target
		);
	}
	private function paragraphs ($text) {
		$result = "";
		$paras = explode("\n", trim($text));
		foreach ($paras as $para) {
			$para = trim($para);
			$result .= "<p>";
			$result .= $para == "" ? "&nbsp;" : $para;
			$result .= "</p>";
		}
		return $result;
	}
	
	private function fieldProperties ($field) {
		$id = (int)$field['data'];
		$nfield = array(
			'data' => $this->name,
			'label' => (string)$field['label'],
			'usage' => (string)$field['usage']
		);
		if ((string)$field['prompt'] != "") {
			$nfield['prompt'] = (string)$field['prompt'];
		}
		if ((string)$field['required'] == '1') {
			$nfield['required'] = '1';
		}
		$this->dependencies = 'fieldDependencies';
		if ((string)$field['condition'] != "") {
			$this->datas[$id]['unparsedCondition'] = preg_replace_callback(
				"/#(\d+)/", 
				array($this, 'addDependency'),
				(string)$field['condition']
			);
		}
		if ((string)$field['explanation'] != "") {
			$this->datas[$id]['unparsedExplanation'] = preg_replace_callback(
				"/#(\d+)/", 
				array($this, 'addDependency'),
				(string)$field['explanation']
			);
		}
		$this->dependencies = 'noteDependencies';
		if ($field->PreNote) {
			$nfield['prenote'] = $this->paragraphs(preg_replace_callback(
				"/#(\d+)/", 
				array($this, 'addNoteDependency'), 
				(string)$field->PreNote
			));
			if ((string)$field->PreNote['condition'] != "") {
				$this->datas[$id]['unparsedPreNoteCondition'] = preg_replace_callback(
					"/#(\d+)/", 
					array($this, 'addDependency'),
					(string)$field->PreNote['condition']
				);
			}
		}
		if ($field->PostNote) {
			$nfield['postnote'] = $this->paragraphs(preg_replace_callback(
				"/#(\d+)/", 
				array($this, 'addNoteDependency'),
				(string)$field->PostNote
			));
			if ((string)$field->PostNote['condition'] != "") {
				$this->datas[$id]['unparsedPostNoteCondition'] = preg_replace_callback(
					"/#(\d+)/", 
					array($this, 'addDependency'),
					(string)$field->PostNote['condition']
				);
			}
		}
		return $nfield;
	}
	
	protected function toJSONData($data, &$sources) {
		$id = (int)$data['id'];
		$this->datas[$id]['id'] = $id;
		$this->datas[$id]['name'] = (string)$data['name'];
		$this->datas[$id]['type'] = (string)$data['type'];
		$this->name = $this->datas[$id]['name'];
		$this->dependencies = 'dataDependencies';
		if ((string)$data['default'] != "") {
			$this->datas[$id]['unparsedDefault'] = preg_replace_callback(
				"/#(\d+)/", 
				array($this, 'addDependency'),
				(string)$data['default']
			);
		}
		if ((string)$data['min'] != "") {
			$this->datas[$id]['unparsedMin'] = preg_replace_callback(
				"/#(\d+)/", 
				array($this, 'addDependency'),
				(string)$data['min']
			);
		}
		if ((string)$data['max'] != "") {
			$this->datas[$id]['unparsedMax'] = preg_replace_callback(
				"/#(\d+)/", 
				array($this, 'addDependency'),
				(string)$data['max']
			);
		}
		if ((string)$data['content'] != "") {
			$this->datas[$id]['unparsedContent'] = preg_replace_callback(
				"/#(\d+)/", 
				array($this, 'addDependency'),
				(string)$data['content']
			);
		}
		if ((string)$data['source'] != "") {
			$this->datas[$id]['unparsedSource'] = preg_replace_callback(
				"/#(\d+)/", 
				array($this, 'addDependency'),
				(string)$data['source']
			);
		}
		if ((string)$data['index'] != "") {
			$this->datas[$id]['unparsedIndex'] = preg_replace_callback(
				"/#(\d+)/", 
				array($this, 'addDependency'),
				(string)$data['index']
			);
		}
		if ($data->Constraints) {
			$constraints = array();
			foreach ($data->Constraints->Constraint as $constraint) {
				$constraints[(int)$constraint['id']]['unparsedConstraint'] = preg_replace_callback(
					"/#(\d+)/", 
					array($this, 'addDependency'),
					(string)$constraint['constraint']
				);
				$constraints[(int)$constraint['id']]['constraintMessage'] = $this->replaceIdByName((string)$constraint['constraintMessage']);
			}
			$this->datas[$id]['constraints'] = $constraints;
		}
		if ($data->Choices) {
			$choices = array();
			foreach ($data->Choices->Choice as $choice) {
				$choices[] = array(
					(string)$choice['value'] => (string)$choice['label']
				);
			}
			if (count($choices) > 0) {
				$this->datas[$id]['choices'] = $choices;
			}
			if ($data->Choices->Source) {
				$source = $data->Choices->Source;
				$sid = (int)$source['id'];
				$this->datas[$id]['choices']['source'] = array (
					'id' => $sid,
					'valueColumn' => (string)$source['valueColumn'],
					'labelColumn' => (string)$source['labelColumn']
				);
				if (! isset($sources[$sid]['choiceDependencies'])) {
					$sources[$sid]['choiceDependencies'] = array();
				}
				$sources[$sid]['choiceDependencies'][] = $this->datas[$id]['name'];
			}
		}
	}
	
	public function toJSON($url, $stepId = 0) {		
		$json = array();
		$datas = array();
		$constraints = array();
		$sources = array();
		$dataIdMax = 0;
		$simulator = new \SimpleXMLElement($url, LIBXML_NOWARNING, true);
		if ($simulator->DataSet) {
			foreach ($simulator->DataSet->children() as $child) {
				if ($child->getName() == "DataGroup") {
					foreach ($child->Data as $data) {
						$this->toJSONData($data, $sources);
						$id = (int)$data['id'];
						$this->datas[$id]['datagroup'] = (string)$child['name'];
						if ((int)$data['id'] > $dataIdMax) {
							$dataIdMax = (int)$data['id'];
						}
					}
					if ((string)$child['constraint'] != "") {
						$id = (int)$child['id'];
						$this->groupConstraints[$id]['id'] = $id;
						$this->name = "GroupConstraint-" . $id;
						$this->groupConstraints[$id]['name'] = $this->name;
						$this->groupConstraints[$id]['type'] = "group";
						$this->groupConstraints[$id]['group'] = (string)$child['name'];
						$this->dependencies = 'constraintDependencies';
						$this->groupConstraints[$id]['unparsedConstraint'] = preg_replace_callback(
							"/#(\d+)/", 
							array($this, 'addDependency'),
							(string)$child['constraint']
						);
						$this->groupConstraints[$id]['constraintMessage'] = $this->replaceIdByName((string)$child['constraintMessage']);
					}
					
					if ($child->Constraints) {
						$constraints = array();
						foreach ($child->Constraints->Constraint as $constraint) {
							$id = (int)$child['id'].'-'.(int)$constraint['id'];
							$this->groupConstraints[$id]['id'] = $id;
							$this->name = "GroupConstraint-" . $id;
							$this->groupConstraints[$id]['name'] = $this->name;
							$this->groupConstraints[$id]['type'] = "group";
							$this->groupConstraints[$id]['group'] = (string)$child['name'];
							$this->dependencies = 'constraintDependencies';
							$this->groupConstraints[$id]['unparsedConstraint'] = preg_replace_callback(
								"/#(\d+)/", 
								array($this, 'addDependency'),
								(string)$constraint['constraint']
							);
							$this->groupConstraints[$id]['constraintMessage'] = $this->replaceIdByName((string)$constraint['constraintMessage']);
						}
					}
					
				} elseif ($child->getName() == "Data") {
					$this->toJSONData($child, $sources);
					if ((int)$child['id'] > $dataIdMax) {
						$dataIdMax = (int)$child['id'];
					}
				} elseif ($child->getName() == "GlobalConstraints") {
					foreach ($child->Constraint as $constraint) {
						$id = (int)$constraint['id'];
						$this->globalConstraints[$id]['id'] = $id;
						$this->name = "GlobalConstraint-" . $id;
						$this->globalConstraints[$id]['name'] = $this->name;
						$this->globalConstraints[$id]['type'] = "global";
						$this->dependencies = 'constraintDependencies';
						$this->globalConstraints[$id]['unparsedConstraint'] = preg_replace_callback(
							"/#(\d+)/", 
							array($this, 'addDependency'),
							(string)$constraint['constraint']
						);
						$this->globalConstraints[$id]['constraintMessage'] = $this->replaceIdByName((string)$constraint['constraintMessage']);
					}
				}
			}
		}
		$json["name"] = (string)$simulator["name"];
		$json["label"] = (string)$simulator["label"];
		$json["description"] = $this->paragraphs($simulator->Description);
		$fieldsets = array();
		$actions = array();
		$footnotes = array();
		$usages = array();
		$nstep = array();
		if ($simulator->Steps) {
			foreach ($simulator->Steps->Step as $step) {
				if ((int)$step['id'] == $stepId) {
					$nstep = array (
						'name' => (string)$step['name'],
						'label' => (string)$step['label']
					);
					foreach ($step->FieldSet as $fieldset) {
						$fields = array();
						
						foreach ($fieldset->children() as $child) {
							if ($child->getName() == "FieldRow") {
								$fieldrow = $child;
								foreach ($fieldrow->Field as $field) {
									$id = (int)$field['data'];
									$data = $this->datas[$id];
									if (!isset($usages[$data['name']])) {
										$usages[$data['name']] = (string)$field['usage'];
										$this->name = $data['name'];
										if ((string)$field['usage'] == 'input') {
											$this->datas[$id]['inputField'] = array(
												(string)$step['name']."-fieldset-".$fieldset['id'],
												count($fields)
											);
										}
										$fields[] = $this->fieldProperties($field);
									}
								}
							} elseif ($child->getName() == "Field") {
								$field = $child;
								$id = (int)$field['data'];
								$data = $this->datas[$id];
								if (!isset($usages[$data['name']])) {
									$usages[$data['name']] = (string)$field['usage'];
									$this->name = $data['name'];
									if ((string)$field['usage'] == 'input') {
										$this->datas[$id]['inputField'] = array(
											(string)$step['name']."-fieldset-".$fieldset['id'],
											count($fields)
										);
									}
									$fields[] = $this->fieldProperties($field);
								}
							}
						}
						$nfieldset = array(
							'id'	 => (int)$fieldset['id'],
							'legend' => (string)$fieldset->Legend,
							'fields' => $fields
						);
						$this->name = (string)$step['name']."-fieldset-".$fieldset['id'];
						$this->dependencies = 'fieldsetDependencies';
						if ((string)$fieldset['condition'] != "") {
							$nfieldset['unparsedCondition'] = preg_replace_callback(
								"/#(\d+)/", 
								array($this, 'addDependency'),
								(string)$fieldset['condition']
							);
						}
						$fieldsets[$this->name] = $nfieldset;
					}
					$nstep["fieldsets"] = $fieldsets;
					foreach ($step->ActionList as $actionList) {
						foreach ($actionList as $action) {
							$this->name = (string)$action['name'];
							$this->dependencies = 'actionDependencies';
							$naction = array(
								'label'	 => (string)$action['label']
							);
							if ((string)$action['condition'] != "") {
								$naction['unparsedCondition'] = preg_replace_callback(
									"/#(\d+)/", 
									array($this, 'addDependency'),
									(string)$action['condition']
								);
							}
							$actions[$this->name] = $naction;
						}
					}
					foreach ($step->FootNotes as $footnoteList) {
						foreach ($footnoteList as $footnote) {
							$this->name = (int)$footnote['id'];
							$this->dependencies = 'footNoteDependencies';
							$nfootnote = array(
								'text'	=> $this->paragraphs(preg_replace_callback(
									"/#(\d+)/", 
									array($this, 'addNoteDependency'), 
									$footnote
								))
							);
							if ((string)$footnote['condition'] != "") {
								$nfootnote['unparsedCondition'] = preg_replace_callback(
									"/#(\d+)/", 
									array($this, 'addDependency'),
									(string)$footnote['condition']
								);
							}
							$footnotes[$this->name] = $nfootnote;
						}
					}
					$nstep["actions"] = $actions;
					$nstep["footnotes"] = $footnotes;
				}
			}
		}
		if ($simulator->Sources) {
			foreach ($simulator->Sources->Source as $source) {
				$id = (int)$source['id'];
				$this->name = $id;
				$this->dependencies = 'sourceDependencies';
				$parameters = array();
				foreach ($source->Parameter as $parameter) {
					$data = $this->datas[(int)$parameter['data']];
					$parameters[(string)$parameter['name']] = $data['name'];
					$this->addDependency(array(null, (int)$parameter['data']));
				}
				$sources[$id]['parameters'] = $parameters;
			}
		}
		foreach ($this->datas as $id => $data) {
			$name = $data['name'];
			unset($data['name']);
			foreach($data as $key => $value) {
				$datas[$name][$key] = $value;
			}
		}
		foreach ($this->groupConstraints as $id => $groupConstraint) {
			$name = $groupConstraint['name'];
			unset($groupConstraint['name']);
			foreach($groupConstraint as $key => $value) {
				$constraints[$name][$key] = $value;
			}
		}
		foreach ($this->globalConstraints as $id => $globalConstraint) {
			$name = $globalConstraint['name'];
			unset($globalConstraint['name']);
			foreach($globalConstraint as $key => $value) {
				$constraints[$name][$key] = $value;
			}
		}
		$json["datas"] = $datas;
		$json["constraints"] = $constraints;
		$json["step"] = $nstep;
		$json["sources"] = $sources;
		if ($this->controller->isDevelopmentEnvironment() && ! version_compare(phpversion(), '5.4.0', '<')) {
			return json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE |  JSON_UNESCAPED_SLASHES);
		} else {
			return json_encode($json);
		}
	}
	
	public function save($file) {
	}
}

?>