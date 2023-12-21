import SpoqaHanRegular from './SpoqaHanSansNeo-Regular.woff';
import SpoqaHanRegularWoff2 from './SpoqaHanSansNeo-Regular.woff2';
import SpoqaHanBold from './SpoqaHanSansNeo-Bold.woff';
import SpoqaHanBoldWoff2 from './SpoqaHanSansNeo-Bold.woff2';
import SpoqaHanLight from './SpoqaHanSansNeo-Light.woff';
import SpoqaHanLightWoff2 from './SpoqaHanSansNeo-Light.woff2';
import SpoqaHanMedium from './SpoqaHanSansNeo-Medium.woff';
import SpoqaHanMediumWoff2 from './SpoqaHanSansNeo-Medium.woff2';



const SpoqaHanRegular = {
  fontFamily: 'SpoqaHan',
  fontStyle: 'normal',
  fontWeight: 400,
  src: `local('SpoqaHanSansNeo'),
  url(${regular}) format('woff'),
  url(${regularWoff2}) format('woff2')`,
};

const SpoqaHanBold = {
  fontFamily: 'SpoqaHan',
  fontStyle: 'normal',
  fontWeight: 700,
  src: `local('SpoqaHanSansNeo'),
  url(${bold}) format('woff'),
  url(${boldWoff2}) format('woff2')`,
};

export default [SpoqaHanRegular, SpoqaHanBold]
