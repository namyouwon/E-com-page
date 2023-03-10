/* eslint-env jest */
import React from 'react';
import {
  ComposerOverflowMenu,
  DockedComposerPanel,
  Footer
} from '../base/example';

import { Modal, ModalContent } from '../../modals/base/example';

import createHelpers from '../../../../jest.helpers';

const { matchesMarkup } = createHelpers(__dirname);

const dialogHeadingId = 'dialog-heading-id-1';
const dialogBodyId = 'dialog-content-id-1';

it('renders a docked composer', () =>
  matchesMarkup(
    <div className="slds-docked_container">
      <DockedComposerPanel className="slds-is-open" footer={<Footer />}>
        <div className="slds-align_absolute-center">
          Docked Composer Panel Body <br /> This area consumes the feature
        </div>
      </DockedComposerPanel>
    </div>
  ));

it('renders a docked composer with single composer open', () =>
  matchesMarkup(
    <div className="slds-docked_container">
      <DockedComposerPanel className="slds-is-open" footer={<Footer />}>
        <div className="slds-align_absolute-center">
          Docked Composer Panel Body <br /> This area consumes the feature
        </div>
      </DockedComposerPanel>
    </div>
  ));

it('renders a focused docked composer', () =>
  matchesMarkup(
    <div className="slds-docked_container">
      <DockedComposerPanel
        className="slds-is-open slds-has-focus"
        footer={<Footer />}
      >
        <div className="slds-align_absolute-center">
          Docked Composer Panel Body <br /> This area consumes the feature
        </div>
      </DockedComposerPanel>
    </div>
  ));

it('renders a closed docked composer', () =>
  matchesMarkup(
    <div className="slds-docked_container">
      <DockedComposerPanel dialogClosed footer={<Footer />}>
        <div className="slds-align_absolute-center">
          Docked Composer Panel Body <br /> This area consumes the feature
        </div>
      </DockedComposerPanel>
    </div>
  ));

it('renders a closed and focused docked composer', () =>
  matchesMarkup(
    <div className="slds-docked_container">
      <DockedComposerPanel
        className="slds-has-focus"
        dialogClosed
        footer={<Footer />}
      >
        <div className="slds-align_absolute-center">
          Docked Composer Panel Body <br /> This area consumes the feature
        </div>
      </DockedComposerPanel>
    </div>
  ));

it('renders a docked composer with popout', () =>
  matchesMarkup(
    <div>
      <Modal
        className="slds-docked-composer-modal"
        aria-labelledby={dialogHeadingId}
        aria-describedby={dialogBodyId}
        closeButton={false}
      >
        <ModalContent id="modal-content-id">
          <DockedComposerPanel footer={<Footer />} nestedDialog>
            <div className="slds-align_absolute-center">
              Docked Composer Panel Body <br /> This area consumes the feature
            </div>
          </DockedComposerPanel>
        </ModalContent>
      </Modal>
      <div className="slds-backdrop slds-backdrop_open" />
    </div>
  ));

it('renders a docked composer with multiple composer overflow', () =>
  matchesMarkup(
    <div className="slds-docked_container">
      <ComposerOverflowMenu />
      <DockedComposerPanel className="slds-is-open" footer={<Footer />}>
        <div className="slds-align_absolute-center">
          Docked Composer Panel Body <br /> This area consumes the feature
        </div>
      </DockedComposerPanel>
    </div>
  ));
