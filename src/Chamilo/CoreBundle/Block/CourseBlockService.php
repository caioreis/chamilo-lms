<?php

namespace Chamilo\CoreBundle\Block;

use Symfony\Component\HttpFoundation\Response;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Validator\ErrorElement;

use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\BlockBundle\Block\BaseBlockService;
use Sonata\BlockBundle\Block\BlockContextInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CourseBlockService extends BaseBlockService
{
    public function getName()
    {
        return 'Course block';
    }

    public function setDefaultSettings(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'template' => 'ChamiloCoreBundle:Block:course.html.twig',
            'ttl' => 0
        ));
    }

    public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
    {
    }

    public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
    {
    }

    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        // merge settings
        $settings = $blockContext->getSettings();
        $hotCourses = \CourseManager::return_hot_courses();

        return $this->renderResponse($blockContext->getTemplate(), array(
            'hot_courses' => $hotCourses,
            'block'     => $blockContext->getBlock(),
            'settings'  => $settings
        ), $response);
    }
}