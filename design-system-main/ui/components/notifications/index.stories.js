import * as BaseExamples from './base/example';
import { generateStories } from '../../shared/helpers';
import Docs from './docs.mdx';

const examples = [BaseExamples];

const patternName = 'Notifications';

generateStories(patternName, examples, ['default', 'examples', 'states'], Docs);