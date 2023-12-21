import regular from './SpoqaHanSansNeo-Regular.woff';
import regularWoff2 from './SpoqaHanSansNeo-Regular.woff2';
import bold from './SpoqaHanSansNeo-Bold.woff';
import boldWoff2 from './SpoqaHanSansNeo-Bold.woff2';
import light from './SpoqaHanSansNeo-Light.woff';
import lightWoff2 from './SpoqaHanSansNeo-Light.woff2';
import medium from './SpoqaHanSansNeo-Medium.woff';
import mediumWoff2 from './SpoqaHanSansNeo-Medium.woff2';



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
