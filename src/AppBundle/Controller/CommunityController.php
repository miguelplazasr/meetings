<?php
/**
 * Created by PhpStorm.
 * User: miguelplazas
 * Date: 10/08/15
 * Time: 1:41 PM
 */

namespace AppBundle\Controller;

use AppBundle\Exception\InvalidFormException;
use AppBundle\Form\CommunityType;
use AppBundle\Model\CommunityInterface;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CommunityController extends FOSRestController
{
    /**
     * return AppBundle\Handler\CommunityHandler
     */
    public function getCommunityHandler()
    {
        return $this->get('app.handler.community_handler');
    }

    /**
     * List all communities.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing pages.")
     * @Annotations\QueryParam(name="limit", requirements="\d+", default="5", description="How many pages to return.")
     *
     * @Annotations\View(
     *  templateVar="communities"
     * )
     *
     * @param Request               $request      the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */
    public function getCommunitiesAction(Request $request, ParamFetcherInterface $paramFetcher)
    {
        $offset = $paramFetcher->get('offset');
        $offset = null == $offset ? 0 : $offset;
        $limit = $paramFetcher->get('limit');

        return $this->getCommunityHandler()->all($limit, $offset);
    }

    /**
     * Get single Community.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Gets a Community for a given id",
     *   output = "AppBundle\Entity\Community",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the page is not found"
     *   }
     * )
     *
     * @Annotations\View(templateVar="community")
     *
     * @param int $id the community id
     *
     * @return array
     *
     * @throws NotFoundHttpException when community not exist
     */
    public function getCommunityAction($id)
    {
        $community = $this->getOr404($id);

        return $community;
    }

    /**
     * Presents the form to use to create a new community.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\View(
     *  templateVar = "form"
     * )
     *
     * @return FormTypeInterface
     */
    public function newCommunityAction()
    {
        return $this->createForm(new CommunityType());
    }

    /**
     * Create a Community from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Creates a new community from the submitted data.",
     *   input = "AppBundle\Form\CommunityType",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "AppBundle:Community:newCommunity.html.twig",
     *  statusCode = Codes::HTTP_BAD_REQUEST,
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     */
    public function postCommunityAction(Request $request)
    {
        try {
            $newCommunity = $this->getCommunityHandler()->post(
                $request->request->all()
            );

            $routeOptions = array(
                'id' => $newCommunity->getId(),
                '_format' => $request->get('_format')
            );

            return $this->routeRedirectView('get_community', $routeOptions, Codes::HTTP_CREATED);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

    /**
     * Update existing community from the submitted data or create a new community at a specific location.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "AppBundle\Form\CommunityType",
     *   statusCodes = {
     *     201 = "Returned when the Page is created",
     *     204 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "AppBundle:Community:editCommunity.html.twig",
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     * @param int $id the page id
     *
     * @return FormTypeInterface|View
     *
     * @throws NotFoundHttpException when page not exist
     */
    public function putCommunityAction(Request $request, $id)
    {
        try {
            if (!($community = $this->getCommunityHandler()->get($id))) {
                $statusCode = Codes::HTTP_CREATED;
                $community = $this->getCommunityHandler()->post(
                    $request->request->all()
                );
            } else {
                $statusCode = Codes::HTTP_NO_CONTENT;
                $community = $this->getCommunityHandler()->put(
                    $community,
                    $request->request->all()
                );
            }

            $routeOptions = array(
                'id' => $community->getId(),
                '_format' => $request->get('_format')
            );

            return $this->routeRedirectView('get_community', $routeOptions, $statusCode);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

    /**
     * Update existing community from the submitted data or create a new community at a specific location.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "AppBundle\Form\CommunityType",
     *   statusCodes = {
     *     204 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "AppBundle:Community:editCommunity.html.twig",
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     * @param int $id the page id
     *
     * @return FormTypeInterface|View
     *
     * @throws NotFoundHttpException when page not exist
     */
    public function patchCommunityAction(Request $request, $id)
    {
        try {
            $community = $this->getCommunityHandler()->patch(
                $this->getOr404($id),
                $request->request->all()
            );

            $routeOptions = array(
                'id' => $community->getId(),
                '_format' => $request->get('_format')
            );

            return $this->routeRedirectView('get_community', $routeOptions, Codes::HTTP_NO_CONTENT);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

    /**
     * Presents the form to use to update an existing community.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes={
     *     200 = "Returned when successful",
     *     404 = "Returned when the note is not found"
     *   }
     * )
     *
     * @Annotations\View()
     *
     * @param Request $request the request object
     * @param int $id the note id
     *
     * @return FormTypeInterface
     *
     * @throws NotFoundHttpException when community not exist
     */
    public function editCommunityAction(Request $request, $id)
    {
        $community = $this->getCommunityHandler()->get($id);

        if (!$community) {
            throw $this->createNotFoundException("Community does not exist.");
        }

        return $this->createForm(new CommunityType(), $community);

    }

    /**
     * Removes a community.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes={
     *     204="Returned when successful"
     *   }
     * )
     *
     * @param int $id the community id
     * @return array|View|null
     */
    public function deleteCommunityAction($id)
    {
        try {

            $community = $this->getOr404($id);
            $this->getCommunityHandler()->delete($community);

        } catch (InvalidFormException $exception) {
            return $exception->getForm();
        }
        return $this->routeRedirectView('get_communities');

    }

    /**
     * Removes a community.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes={
     *     204="Returned when successful",
     *     404="Returned when the community is not found"
     *   }
     * )
     *
     * @param int $id the community id
     * @return RouteRedirectView
     */
    public function removeCommunityAction($id)
    {
        return $this->deleteCommunityAction($id);
    }


    /**
     * Fetch a Community or throw an 404 Exception.
     *
     * @param mixed $id
     *
     * @return CommunityInterface
     *
     * @throws NotFoundHttpException
     */
    protected function getOr404($id)
    {
        if (!($page = $this->getCommunityHandler()->get($id))) {
            throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.', $id));
        }

        return $page;
    }


}