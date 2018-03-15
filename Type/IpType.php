<?php 

namespace Ev\IpFieldTypeBundle\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;

class IpType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'version' => 'ipv4',
        ));
    }

    public function getParent()
    {
        return 'text';
    }

	/**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
    	if ($options['version'] == 'ipv4')
	        $view->vars = array_replace($view->vars, array(
	            'ip_conf'          => array('version' => 4,
					    				   'max_value' => 255,
					    				   'group' => 4,
					    				   'group_length' => 3,
					    				   'sep' => '.',
					    				   'base' => 10, )
	        ));
        else if ($options['version'] == 'ipv6')
            $view->vars = array_replace($view->vars, array(
                'ip_conf'          => array('version' => 6,
                                           'max_value' => 0xffff,
                                           'group' => 8,
                                           'group_length' => 2,
                                           'sep' => ':',
                                           'base' => 16, )
            ));
        else if ($options['version'] == 'mac')
            $view->vars = array_replace($view->vars, array(
                'ip_conf'          => array('version' => 'mac',
                                           'max_value' => 0xff,
                                           'group' => 6,
                                           'group_length' => 2,
                                           'sep' => ':',
                                           'base' => 16, )
            ));
    	else
    		$view->vars = array_replace($view->vars, array(
	            'ip_conf'          => $options['version']
	        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ipfield';
    }
}