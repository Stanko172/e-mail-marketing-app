import { RenderResult, cleanup, render, screen } from '@testing-library/vue';
import { afterEach, beforeEach, describe, expect, it } from 'vitest';
import { Button } from './components';

describe('components/ui/Button', () => {
    afterEach(() => {
        cleanup();
    });

    describe('loading state.', () => {
        let wrapper: RenderResult;

        beforeEach(() => {
            wrapper = render(Button, {
                props: {
                    loading: true,
                },
            });
        });

        it('disables the button.', () => {
            const { getByRole } = wrapper;

            const button = getByRole('button');

            expect(button.getAttribute('disabled')).toBeDefined();
        });

        it('changes opacity.', () => {
            const { getByRole } = wrapper;

            const button = getByRole('button');

            expect(button.classList).toContain(['opacity-25']);
        });

        it('shows Spinner component.', async () => {
            const { findByTestId } = wrapper;

            await findByTestId('spinner');
        });
    });

    describe('active state.', () => {
        it('can render the default slot content.', () => {
            const { getByText } = render(Button, {
                slots: {
                    default: 'Submit',
                },
            });

            getByText('Submit');
        });
    });

    describe('disabled.', () => {
        it('reduces opacity.', () => {
            const { getByRole } = render(Button, {
                props: {
                    disabled: true,
                },
            });

            const button = getByRole('button');

            expect(button.classList).toContain(['opacity-25']);
        });
    });

    describe('enabled.', () => {
        it("doesn't change opacity.", () => {
            const { getByRole } = render(Button);

            const button = getByRole('button');

            expect(button.classList.contains('opacity-25')).toBe(false);
        });
    });
});
