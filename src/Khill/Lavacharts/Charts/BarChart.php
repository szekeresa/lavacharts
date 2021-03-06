<?php namespace Khill\Lavacharts\Charts;

/**
 * BarChart Class
 *
 * A vertical bar chart that is rendered within the browser using SVG or VML.
 * Displays tips when hovering over bars. For a horizontal version of this
 * chart, see the Bar Chart.
 *
 *
 * @package    Lavacharts
 * @subpackage Charts
 * @since      v2.3.0
 * @author     Kevin Hill <kevinkhill@gmail.com>
 * @copyright  (c) 2015, KHill Designs
 * @link       http://github.com/kevinkhill/lavacharts GitHub Repository Page
 * @link       http://lavacharts.com                   Official Docs Site
 * @license    http://opensource.org/licenses/MIT MIT
 */

use Khill\Lavacharts\Utils;

class BarChart extends Chart
{
    public $type = 'BarChart';

    public function __construct($chartLabel)
    {
        parent::__construct($chartLabel);

        $this->defaults = array_merge(
            $this->defaults,
            array(
                //'animation'
                'annotations',
                'axisTitlesPosition',
                'bar.groupWidth',
                'bars',
                'chart.subtitle',
                'chart.title',
                'dataOpacity',
                'enableInteractivity',
                'focusTarget',
                'forceIFrame',
                'hAxes',
                'hAxis',
                'isStacked',
                'reverseCategories',
                'orientation',
                'series',
                'theme',
                'trendlines',
                'trendlines.n.color',
                'trendlines.n.degree',
                'trendlines.n.labelInLegend',
                'trendlines.n.lineWidth',
                'trendlines.n.opacity',
                'trendlines.n.pointSize',
                'trendlines.n.showR2',
                'trendlines.n.type',
                'trendlines.n.visibleInLegend',
                'vAxis',
                'vAxis'
            )
        );
    }

    /**
     * Defines how chart annotations will be displayed.
     *
     * @param  Annotation $a
     * @return BarChart
     */
    public function annotations(Annotation $a)
    {
        return $this->addOption($a->toArray());
    }

    /**
     * Where to place the axis titles, compared to the chart area. Supported values:
     * in - Draw the axis titles inside the the chart area.
     * out - Draw the axis titles outside the chart area.
     * none - Omit the axis titles.
     *
     * @param  string   $position
     * @return BarChart
     */
    public function axisTitlesPosition($position)
    {
        $values = array(
            'in',
            'out',
            'none'
        );

        if (Utils::nonEmptyStringInArray($position, $values)) {
            $this->addOption(array('axisTitlesPosition' => $position));
        } else {
            throw $this->invalidConfigValue(
                __FUNCTION__,
                'string',
                'with a value of '.Utils::arrayToPipedString($values)
            );
        }

        return $this;
    }

    /**
     * The width of a group of bars, specified in either of these formats:
     * - Pixels (e.g. 50).
     * - Percentage of the available width for each group (e.g. '20%'),
     *   where '100%' means that groups have no space between them.
     *
     * @param  mixed       $barGroupWidth
     * @return BarChart
     */
    public function barGroupWidth($barGroupWidth)
    {
        if (Utils::isIntOrPercent($barGroupWidth)) {
            $this->addOption(array('bar' => array('groupWidth' => $barGroupWidth)));
        } else {
            throw $this->invalidConfigValue(
                __FUNCTION__,
                'string | int',
                'must be a valid int or percent [ 50 | 65% ]'
            );
        }

        return $this;
    }

    /**
     * An object with members to configure various horizontal axis elements. To
     * specify properties of this property, create a new hAxis() object, set
     * the values then pass it to this function or to the constructor.
     *
     * @param  Lavacharts\Configs\HorizontalAxis $hAxis
     * @throws InvalidConfigValue
     * @return BarChart
     */
    public function hAxis(HorizontalAxis $hAxis)
    {
        $this->addOption($hAxis->toArray('hAxis'));

        return $this;
    }

    /**
     * If set to true, series elements are stacked.
     *
     * @param  bool        $isStacked
     * @return BarChart
     */
    public function isStacked($isStacked)
    {
        if (is_bool($isStacked)) {
            $this->addOption(array('isStacked' => $isStacked));
        } else {
            throw $this->invalidConfigValue(
                __FUNCTION__,
                'bool'
            );
        }

        return $this;
    }

    /**
     * An object with members to configure various vertical axis elements. To
     * specify properties of this property, create a new vAxis() object, set
     * the values then pass it to this function or to the constructor.
     *
     * @param  Lavacharts\Configs\VerticalAxis $vAxis
     * @throws InvalidConfigValue
     * @return BarChart
     */
    public function vAxis(VerticalAxis $vAxis)
    {
        $this->addOption($vAxis->toArray('vAxis'));

        return $this;
    }
}
