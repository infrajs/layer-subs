<?php
namespace infrajs\controller;
use infrajs\path\Path;
use infrajs\event\Event;
use infrajs\each\Each;

Event::handler('Controller.oninit', function () {
	Run::runAddKeys('subs');

	//if (!class_exists('External')) return;
	//External::add('subs', 'divs');
},'subs:external,div');

Event::handler('Layer.oncheck', function (&$layer) {
	if (empty($layer['parent'])) return;
	if (!empty($layer['parent']['subs'])) {
		//forx бежим по свойствам объекта, как по массивам. Массивы могут быть вложенные
		//var_dump($layer['parent']['subs']);
		$key = Each::forx($layer['parent']['subs'], function (&$l, $key) use (&$layer) {//Такую пробежку у родителя сразу для всех детей делать не нельзя, так как external у детей ещё не сделан.
			if (Each::isEqual($layer, $l)) {
				return $key;
			}//Ага, текущей слой описан у родителя в subs. Любой return останавливает цикл и возвращает иначе key был бы undefined.
		});
		if ($key) {
			//Так так теперь предопределяем свойства
			//div не круче external.(но в external div не указывается) в  tpl и tplroot не круче
			$layer['div'] = $key;
			$layer['sub'] = true;
		}
	}
	if (!empty($layer['sub'])) {
		//if(@!$layer['div'])$layer['div']=$key;
		if (empty($layer['tpl'])) $layer['tpl'] = $layer['parent']['tpl'];
		if (empty($layer['tplroot'])) $layer['tplroot'] = $layer['div'];
	}
}, 'subs:external,div');