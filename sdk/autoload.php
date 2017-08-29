<?php
/**
 * Created by CDiscount
 * User: CDiscount
 * Date: 22/09/2016
 * Time: 12:03
 */
 
 
require_once __DIR__ . '/src/core/Soap/BaliseTool.php';

require_once __DIR__ . '/src/core/Auth/Token.php';

require_once __DIR__ . '/src/core/Common/CommonResult.php';
require_once __DIR__ . '/src/core/Common/ReportLog.php';
require_once __DIR__ . '/src/core/Common/ReportPropertyLog.php';

require_once __DIR__ . '/src/core/ConfigTools/ConfigFileLoader.php';

require_once __DIR__ . '/src/core/Customer/Customer.php';

require_once __DIR__ . '/src/core/Delivery/DeliveryMode.php';
require_once __DIR__ . '/src/core/Delivery/DeliveryModeInformation.php';
require_once __DIR__ . '/src/core/Delivery/ShippingInformation.php';

require_once __DIR__ . '/src/core/Discussion/CloseDiscussionResult.php';
require_once __DIR__ . '/src/core/Discussion/GenericQuestion.php';
require_once __DIR__ . '/src/core/Discussion/Message.php';
require_once __DIR__ . '/src/core/Discussion/OfferQuestion.php';
require_once __DIR__ . '/src/core/Discussion/OrderQuestion.php';
require_once __DIR__ . '/src/core/Discussion/OrderClaim.php';

require_once __DIR__ . '/src/core/HttpTools/CDSApiRequest.php';
require_once __DIR__ . '/src/core/HttpTools/CDSApiSoapRequest.php';

require_once __DIR__ . '/src/core/Mail/DiscussionMail.php';

require_once __DIR__ . '/src/core/Offer/Offer.php';
require_once __DIR__ . '/src/core/Offer/OfferBenchMark.php';
require_once __DIR__ . '/src/core/Offer/OfferPool.php';
require_once __DIR__ . '/src/core/Offer/OfferReportLog.php';
require_once __DIR__ . '/src/core/Offer/OfferReportPropertyLog.php';

require_once __DIR__ . '/src/core/Order/Corporation.php';
require_once __DIR__ . '/src/core/Order/Order.php';
require_once __DIR__ . '/src/core/Order/OrderLine.php';
require_once __DIR__ . '/src/core/Order/OrderLineList.php';
require_once __DIR__ . '/src/core/Order/OrderList.php';
require_once __DIR__ . '/src/core/Order/ParcelActionResult.php';
require_once __DIR__ . '/src/core/Order/ParcelActionResultList.php';
require_once __DIR__ . '/src/core/Order/Voucher.php';
require_once __DIR__ . '/src/core/Order/VoucherList.php';

require_once __DIR__ . '/src/core/Order/Refund/CommercialGestureList.php';
require_once __DIR__ . '/src/core/Order/Refund/RefundInformationMessage.php';
require_once __DIR__ . '/src/core/Order/Refund/SellerRefundResult.php';
require_once __DIR__ . '/src/core/Order/Refund/SellerRefundResultList.php';

require_once __DIR__ . '/src/core/Order/Validate/ValidateOrder.php';
require_once __DIR__ . '/src/core/Order/Validate/ValidateOrderLine.php';
require_once __DIR__ . '/src/core/Order/Validate/ValidateOrderLineResult.php';
require_once __DIR__ . '/src/core/Order/Validate/ValidateOrderLineResults.php';
require_once __DIR__ . '/src/core/Order/Validate/ValidateOrderResult.php';
require_once __DIR__ . '/src/core/Order/Validate/ValidateOrderResults.php';


require_once __DIR__ . '/src/core/Parcel/Parcel.php';
require_once __DIR__ . '/src/core/Parcel/ParcelItem.php';
require_once __DIR__ . '/src/core/Parcel/ParcelItemList.php';
require_once __DIR__ . '/src/core/Parcel/ParcelList.php';
require_once __DIR__ . '/src/core/Parcel/Tracking.php';
require_once __DIR__ . '/src/core/Parcel/TrackingList.php';

require_once __DIR__ . '/src/core/Product/CategoryTree.php';
require_once __DIR__ . '/src/core/Product/KeyValueProperty.php';
require_once __DIR__ . '/src/core/Product/Product.php';
require_once __DIR__ . '/src/core/Product/ProductIdentity.php';
require_once __DIR__ . '/src/core/Product/ProductMatching.php';
require_once __DIR__ . '/src/core/Product/ProductModel.php';
require_once __DIR__ . '/src/core/Product/ProductReportLog.php';
require_once __DIR__ . '/src/core/Product/ProductReportPropertyLog.php';

require_once __DIR__ . '/src/core/Seller/Seller.php';
require_once __DIR__ . '/src/core/Seller/Address.php';
require_once __DIR__ . '/src/core/Seller/SellerIndicator.php';

require_once __DIR__ . '/src/core/Soap/Common/Body.php';
require_once __DIR__ . '/src/core/Soap/Common/Envelope.php';
require_once __DIR__ . '/src/core/Soap/Common/iResponse.php';
require_once __DIR__ . '/src/core/Soap/Common/SoapTools.php';


require_once __DIR__ . '/src/core/Soap/Discussion/Response/GetOrderClaimListResponse.php';
require_once __DIR__ . '/src/core/Soap/Discussion/Response/GetOfferQuestionListResponse.php';
require_once __DIR__ . '/src/core/Soap/Discussion/Response/GetOrderQuestionListResponse.php';
require_once __DIR__ . '/src/core/Soap/Discussion/Response/CloseDiscussionListResponse.php';

require_once __DIR__ . '/src/core/Soap/Discussion/FilterSoap.php';
require_once __DIR__ . '/src/core/Soap/Discussion/ClaimFilterSoap.php';
require_once __DIR__ . '/src/core/Soap/Discussion/GetOfferQuestionList.php';
require_once __DIR__ . '/src/core/Soap/Discussion/OfferQuestionFilterSoap.php';
require_once __DIR__ . '/src/core/Soap/Discussion/OrderQuestionFilterSoap.php';
require_once __DIR__ . '/src/core/Soap/Discussion/GetOrderClaimList.php';
require_once __DIR__ . '/src/core/Soap/Discussion/GetOrderQuestionList.php';
require_once __DIR__ . '/src/core/Soap/Discussion/CloseDiscussionList.php';

require_once __DIR__ . '/src/core/Soap/HeaderMessage/HeaderMessage.php';
require_once __DIR__ . '/src/core/Soap/HeaderMessage/Localization.php';
require_once __DIR__ . '/src/core/Soap/HeaderMessage/Context.php';
require_once __DIR__ . '/src/core/Soap/HeaderMessage/Security.php';

require_once __DIR__ . '/src/core/Soap/Mail/Response/GetDiscussionMailListResponse.php';
require_once __DIR__ . '/src/core/Soap/Mail/Response/GenerateDiscussionMailGuidResponse.php';

require_once __DIR__ . '/src/core/Soap/Mail/GenerateDiscussionMailGuid.php';
require_once __DIR__ . '/src/core/Soap/Mail/GetDiscussionMailList.php';
require_once __DIR__ . '/src/core/Soap/Mail/Request.php';

require_once __DIR__. '/src/core/Soap/Offer/Response/GetOfferListGenericResponse.php';
require_once __DIR__. '/src/core/Soap/Offer/Response/GetOfferListPaginatedResponse.php';
require_once __DIR__. '/src/core/Soap/Offer/Response/GetOfferListResponse.php';
require_once __DIR__. '/src/core/Soap/Offer/Response/GetOfferPackageSubmissionResultResponse.php';
require_once __DIR__. '/src/core/Soap/Offer/Response/SubmitOfferPackageResponse.php';

require_once __DIR__ . '/src/core/Soap/Offer/GetOfferList.php';
require_once __DIR__ . '/src/core/Soap/Offer/OfferFilter.php';
require_once __DIR__ . '/src/core/Soap/Offer/GetOfferListPaginated.php';
require_once __DIR__ . '/src/core/Soap/Offer/GetOfferPackageSubmissionResult.php';
require_once __DIR__ . '/src/core/Soap/Offer/SubmitOfferPackage.php';

require_once __DIR__ . '/src/core/Soap/Order/Refund/CreateRefundVoucherAfterShipment.php';
require_once __DIR__ . '/src/core/Soap/Order/Refund/CreateRefundVoucherSoap.php';
require_once __DIR__ . '/src/core/Soap/Order/Refund/RefundInformationSoap.php';
require_once __DIR__ . '/src/core/Soap/Order/Refund/RequestSoap.php';
require_once __DIR__ . '/src/core/Soap/Order/Refund/SellerRefundRequestSoap.php';

require_once __DIR__ . '/src/core/Soap/Order/Refund/Response/CreateRefundVoucherResponse.php';

require_once __DIR__ . '/src/core/Soap/Order/Response/ManageParcelResponse.php';

require_once __DIR__ . '/src/core/Soap/Order/GetOrderList.php';
require_once __DIR__ . '/src/core/Soap/Order/GetOrderListResponse.php';
require_once __DIR__ . '/src/core/Soap/Order/ManageParcelSoap.php';
require_once __DIR__ . '/src/core/Soap/Order/OrderFilterSoap.php';
require_once __DIR__ . '/src/core/Soap/Order/OrderLineListSoap.php';
require_once __DIR__ . '/src/core/Soap/Order/OrderListSoap.php';
require_once __DIR__ . '/src/core/Soap/Order/ValidateOrderLineSoap.php';
require_once __DIR__ . '/src/core/Soap/Order/ValidateOrderList.php';
require_once __DIR__ . '/src/core/Soap/Order/ValidateOrderListResponse.php';
require_once __DIR__ . '/src/core/Soap/Order/ValidateOrderSoap.php';

require_once __DIR__ . '/src/core/Soap/Product/GetAllowedCategoryTree.php';
require_once __DIR__ . '/src/core/Soap/Product/GetAllAllowedCategoryTree.php';
require_once __DIR__ . '/src/core/Soap/Product/GetAllModelList.php';
require_once __DIR__ . '/src/core/Soap/Product/GetBrandList.php';
require_once __DIR__ . '/src/core/Soap/Product/GetModelList.php';
require_once __DIR__ . '/src/core/Soap/Product/GetProductList.php';
require_once __DIR__ . '/src/core/Soap/Product/GetProductListByIdentifier.php';
require_once __DIR__ . '/src/core/Soap/Product/IdentifierRequestSoap.php';
require_once __DIR__ . '/src/core/Soap/Product/ModelFilterSoap.php';
require_once __DIR__ . '/src/core/Soap/Product/ProductFilterSoap.php';
require_once __DIR__ . '/src/core/Soap/Product/SubmitProductPackage.php';
require_once __DIR__ . '/src/core/Soap/Product/GetProductPackageProductMatchingFileData.php';
require_once __DIR__ . '/src/core/Soap/Product/GetProductPackageSubmissionResult.php';

require_once __DIR__ . '/src/core/Soap/Product/Response/GetGenericCategoryTreeResponse.php';
require_once __DIR__ . '/src/core/Soap/Product/Response/ModelListResponse.php';
require_once __DIR__ . '/src/core/Soap/Product/Response/GetModelListResponse.php';
require_once __DIR__ . '/src/core/Soap/Product/Response/GetAllModelListResponse.php';
require_once __DIR__ . '/src/core/Soap/Product/Response/GetBrandListResponse.php';
require_once __DIR__ . '/src/core/Soap/Product/Response/GetAllowedCategoryTreeResponse.php';
require_once __DIR__ . '/src/core/Soap/Product/Response/GetAllAllowedCategoryTreeResponse.php';
require_once __DIR__ . '/src/core/Soap/Product/Response/GetProductListResponse.php';
require_once __DIR__ . '/src/core/Soap/Product/Response/GetProductListByIdentifierResponse.php';
require_once __DIR__ . '/src/core/Soap/Product/Response/SubmitProductPackageResponse.php';
require_once __DIR__ . '/src/core/Soap/Product/Response/GetProductPackageSubmissionResultResponse.php';
require_once __DIR__ . '/src/core/Soap/Product/Response/GetProductPackageProductMatchingFileDataResponse.php';

require_once __DIR__ . '/src/core/Soap/Relays/GetParcelShopList.php';

require_once __DIR__ . '/src/core/Soap/Seller/Response/GetSellerIndicatorsResponse.php';

require_once __DIR__ . '/src/core/Soap/Seller/GetSellerIndicators.php';
require_once __DIR__ . '/src/core/Soap/Seller/GetSellerInformation.php';
require_once __DIR__ . '/src/core/Soap/Seller/GetSellerInformationResponse.php';

require_once __DIR__ . '/src/core/Soap/SoapClientDebug.php';

require_once __DIR__ . '/src/core/Soap/XmlUtils.php';
require_once __DIR__ . '/src/core/Soap/SOAPStruct.php';


require_once __DIR__ . '/src/public/ApiClient/CDSApiClient.php';

require_once __DIR__ . '/src/public/Common/Filter.php';


require_once __DIR__ . '/src/public/Discussion/DiscussionFilter.php';
require_once __DIR__ . '/src/public/Discussion/ClaimFilter.php';
require_once __DIR__ . '/src/public/Discussion/DiscussionPoint.php';
require_once __DIR__ . '/src/public/Discussion/DiscussionStatusEnum.php';
require_once __DIR__ . '/src/public/Discussion/OfferQuestionFilter.php';
require_once __DIR__ . '/src/public/Discussion/OrderQuestionFilter.php';

require_once __DIR__ . '/src/public/Mail/MailPoint.php';

require_once __DIR__ . '/src/public/Offer/OfferPoint.php';
require_once __DIR__ . '/src/public/Offer/OfferFilter.php';

require_once __DIR__ . '/src/public/Order/Refund/CreateRefundVoucherRequest.php';
require_once __DIR__ . '/src/public/Order/Refund/RefundInformation.php';
require_once __DIR__ . '/src/public/Order/Refund/RefundOrderLine.php';
require_once __DIR__ . '/src/public/Order/Refund/RefundMotiveEnum.php';
require_once __DIR__ . '/src/public/Order/Refund/RefundRequestModeEnum.php';
require_once __DIR__ . '/src/public/Order/Refund/Request.php';
require_once __DIR__ . '/src/public/Order/Refund/SellerRefundRequest.php';
require_once __DIR__ . '/src/public/Order/Refund/SellerRefundRequestList.php';

require_once __DIR__ . '/src/public/Order/AcceptationStateEnum.php';
require_once __DIR__ . '/src/public/Order/AskingForReturnType.php';
require_once __DIR__ . '/src/public/Order/ManageParcelRequest.php';
require_once __DIR__ . '/src/public/Order/OrderFilter.php';
require_once __DIR__ . '/src/public/Order/OrderPoint.php';
require_once __DIR__ . '/src/public/Order/OrderStateEnum.php';
require_once __DIR__ . '/src/public/Order/OrderStatusEnum.php';
require_once __DIR__ . '/src/public/Order/OrderTypeEnum.php';
require_once __DIR__ . '/src/public/Order/ParcelActionsTypes.php';
require_once __DIR__ . '/src/public/Order/ParcelInfos.php';
require_once __DIR__ . '/src/public/Order/ProductConditionEnum.php';
require_once __DIR__ . '/src/public/Order/ValidationStatusEnum.php';

require_once __DIR__ . '/src/public/Product/Filter.php';
require_once __DIR__ . '/src/public/Product/IdentifierRequest.php';
require_once __DIR__ . '/src/public/Product/IdentifierTypeEnum.php';
require_once __DIR__ . '/src/public/Product/ModelFilter.php';
require_once __DIR__ . '/src/public/Product/ProductFilter.php';
require_once __DIR__ . '/src/public/Product/ProductPoint.php';
require_once __DIR__ . '/src/public/Product/ProductTypeEnum.php';

require_once __DIR__ . '/src/public/Relays/RelaysPoint.php';
require_once __DIR__ . '/src/public/Seller/SellerPoint.php';

require_once __DIR__ . '/src/public/Fulfilment/FulfilmentProductRequest.php';
require_once __DIR__ . '/src/public/Fulfilment/FulfilmentPoint.php';
require_once __DIR__ . '/src/public/Fulfilment/OfferStateActionRequest.php';
require_once __DIR__ . '/src/public/Fulfilment/OfferStateActionType.php';
require_once __DIR__ . '/src/public/Fulfilment/SubmitFulfilmentActivationRequest.php';
require_once __DIR__ . '/src/public/Fulfilment/ProductActivationData.php';
require_once __DIR__ . '/src/public/Fulfilment/FulfilmentProductActionType.php';
require_once __DIR__ . '/src/public/Fulfilment/SupplyOrderRequest.php';
require_once __DIR__ . '/src/public/Fulfilment/FulfilmentOnDemandOrderLineFilter.php';
require_once __DIR__ . '/src/public/Fulfilment/FulfilmentOrderLineListToSupplyMessage.php';
require_once __DIR__ . '/src/public/Fulfilment/WarehouseType.php';
require_once __DIR__ . '/src/public/Fulfilment/OrderStatusRequest.php';
require_once __DIR__ . '/src/public/Fulfilment/OrderIntegrationRequest.php';
require_once __DIR__ . '/src/public/Fulfilment/ExternalOrder.php';
require_once __DIR__ . '/src/public/Fulfilment/ExternalCustomer.php';
require_once __DIR__ . '/src/public/Fulfilment/ExternalOrderLine.php';
require_once __DIR__ . '/src/public/Fulfilment/SupplyOrderRequest.php';
require_once __DIR__ . '/src/public/Fulfilment/FulfilmentDeliveryDocumentRequest.php';
require_once __DIR__ . '/src/public/Fulfilment/SupplyOrderRequest.php';
require_once __DIR__ . '/src/public/Fulfilment/FulfilmentActivationReportRequest.php';
require_once __DIR__ . '/src/public/Fulfilment/SupplyOrderReportRequest.php';
require_once __DIR__ . '/src/public/Fulfilment/FulfilmentOnDemandSupplyOrderRequest.php';
require_once __DIR__ . '/src/public/Fulfilment/FulfilmentOrderLineRequest.php';
require_once __DIR__ . '/src/public/Fulfilment/FulfilmentSupplyOrderRequest.php';
require_once __DIR__ . '/src/public/Fulfilment/FulfilmentProductDescription.php';

require_once __DIR__ . '/src/core/Fulfilment/ProductStock.php';
require_once __DIR__ . '/src/core/Fulfilment/GetFulfilmentDeliveryDocumentResult.php';
require_once __DIR__ . '/src/core/Fulfilment/SubmitOfferStateActionResult.php';
require_once __DIR__ . '/src/core/Fulfilment/ExternalOrderStatus.php';
require_once __DIR__ . '/src/core/Fulfilment/OrderStatusMessage.php';
require_once __DIR__ . '/src/core/Fulfilment/SubmitFulfilmentSupplyOrderResult.php';
require_once __DIR__ . '/src/core/Fulfilment/SubmitFulfilmentOnDemandSupplyOrderResult.php';
require_once __DIR__ . '/src/core/Fulfilment/FulfilmentSupplyOrderReportListResult.php';
require_once __DIR__ . '/src/core/Fulfilment/FulfilmentOrderListToSupplyResult.php';
require_once __DIR__ . '/src/core/Fulfilment/SupplyOrder.php';
require_once __DIR__ . '/src/core/Fulfilment/SupplyOrderList.php';
require_once __DIR__ . '/src/core/Fulfilment/SubmitFulfilmentActivationResult.php';
require_once __DIR__ . '/src/core/Fulfilment/FulfilmentSupplyOrderResult.php';
require_once __DIR__ . '/src/core/Fulfilment/FulfilmentActivationReport.php';
require_once __DIR__ . '/src/core/Fulfilment/FulfilmentActivationReportDetails.php';
require_once __DIR__ . '/src/core/Fulfilment/FulfilmentActivationReportListResult.php';

require_once __DIR__ . '/src/core/Soap/Fulfilment/GetProductStockListSoap.php';
require_once __DIR__ . '/src/core/Soap/Fulfilment/Response/GetProductStockListResponse.php';
require_once __DIR__ . '/src/core/Soap/Fulfilment/CreateExternalOrderSoap.php';
require_once __DIR__ . '/src/core/Soap/Fulfilment/GetExternalOrderStatusSoap.php';
require_once __DIR__ . '/src/core/Soap/Fulfilment/GetFulfilmentActivationReportListSoap.php';
require_once __DIR__ . '/src/core/Soap/Fulfilment/GetFulfilmentDeliveryDocumentSoap.php';
require_once __DIR__ . '/src/core/Soap/Fulfilment/GetFulfilmentOrderListToSupplySoap.php';
require_once __DIR__ . '/src/core/Soap/Fulfilment/GetFulfilmentSupplyOrderReportListSoap.php';
require_once __DIR__ . '/src/core/Soap/Fulfilment/GetFulfilmentSupplyOrderSoap.php';
require_once __DIR__ . '/src/core/Soap/Fulfilment/Response/CreateExternalOrderResponse.php';
require_once __DIR__ . '/src/core/Soap/Fulfilment/Response/FulfilmentSupplyOrderReportListResponse.php';
require_once __DIR__ . '/src/core/Soap/Fulfilment/Response/GetExternalOrderStatusResponse.php';
require_once __DIR__ . '/src/core/Soap/Fulfilment/Response/GetFulfilmentActivationReportRequestXmlResponse.php';
require_once __DIR__ . '/src/core/Soap/Fulfilment/Response/GetFulfilmentDeliveryDocumentResponse.php';
require_once __DIR__ . '/src/core/Soap/Fulfilment/Response/GetFulfilmentOrderListToSupplyResponse.php';
require_once __DIR__ . '/src/core/Soap/Fulfilment/Response/GetFulfilmentSupplyOrderResponse.php';
require_once __DIR__ . '/src/core/Soap/Fulfilment/Response/SubmitFulfilmentActivationResponse.php';
require_once __DIR__ . '/src/core/Soap/Fulfilment/Response/SubmitFulfilmentOnDemandSupplyOrderResponse.php';
require_once __DIR__ . '/src/core/Soap/Fulfilment/Response/SubmitFulfilmentSupplyOrderResponse.php';
require_once __DIR__ . '/src/core/Soap/Fulfilment/Response/SubmitOfferStateActionResponse.php';
require_once __DIR__ . '/src/core/Soap/Fulfilment/SubmitFulfilmentActivationSoap.php';
require_once __DIR__ . '/src/core/Soap/Fulfilment/SubmitFulfilmentOnDemandSupplyOrderSoap.php';
require_once __DIR__ . '/src/core/Soap/Fulfilment/SubmitFulfilmentSupplyOrderSoap.php';
require_once __DIR__ . '/src/core/Soap/Fulfilment/SubmitOfferStateActionSoap.php';




