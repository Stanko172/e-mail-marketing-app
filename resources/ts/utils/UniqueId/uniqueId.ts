let id = 0;

export default (prefix = 'id'): string => `${prefix}-${++id}`;
