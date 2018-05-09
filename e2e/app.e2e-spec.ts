import { AnguPage } from './app.po';

describe('angu App', () => {
  let page: AnguPage;

  beforeEach(() => {
    page = new AnguPage();
  });

  it('should display welcome message', done => {
    page.navigateTo();
    page.getParagraphText()
      .then(msg => expect(msg).toEqual('Welcome to app!!'))
      .then(done, done.fail);
  });
});
