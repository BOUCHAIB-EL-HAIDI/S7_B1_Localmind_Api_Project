import { setActivePinia, createPinia } from 'pinia';
import { describe, it, expect, beforeEach, vi } from 'vitest';
import { useAuthStore } from './auth';
import axios from 'axios';

vi.mock('axios');

describe('Auth Store', () => {
    beforeEach(() => {
        setActivePinia(createPinia());
        localStorage.clear();
        vi.clearAllMocks();
    });

    it('initializes with no user and token', () => {
        const auth = useAuthStore();
        expect(auth.user).toBeNull();
        expect(auth.token).toBeNull();
        expect(auth.isAuthenticated).toBe(false);
    });

    it('sets user and token on successful login', async () => {
        const auth = useAuthStore();
        const mockUser = { id: 1, name: 'Test User' };
        const mockToken = 'test-token';

        axios.post.mockResolvedValue({
            data: { user: mockUser, access_token: mockToken }
        });

        await auth.login({ email: 'test@example.com', password: 'password' });

        expect(auth.user).toEqual(mockUser);
        expect(auth.token).toBe(mockToken);
        expect(auth.isAuthenticated).toBe(true);
        expect(localStorage.getItem('access_token')).toBe(mockToken);
    });

    it('clears state on logout', async () => {
        const auth = useAuthStore();
        auth.user = { id: 1, name: 'Test User' };
        auth.token = 'test-token';
        localStorage.setItem('access_token', 'test-token');

        axios.post.mockResolvedValue({});

        await auth.logout();

        expect(auth.user).toBeNull();
        expect(auth.token).toBeNull();
        expect(auth.isAuthenticated).toBe(false);
        expect(localStorage.getItem('token')).toBeNull();
    });
});
