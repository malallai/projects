/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   libft.h                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/07 12:38:37 by malallai          #+#    #+#             */
/*   Updated: 2018/11/10 17:55:25 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#ifndef LIBFT_H
# define LIBFT_H
# include <string.h>
# include <unistd.h>
# include <stdlib.h>
# include <stdio.h>

typedef struct		s_list
{
	void			*content;
	size_t			content_size;
	struct s_list	*next;
}					t_list;

void				*ft_memset(void *b, int c, size_t len);
void				ft_bzero(void *s, size_t n);
void			 	*ft_memcpy(void *restrict dst, const void *restrict src, size_t n);
void 				*ft_memccpy(void *restrict dst, const void *restrict src, int c, size_t n);
void				*ft_memmove(void *dst, const void *src, size_t len);
void				*ft_memchr(const void *s, int c, size_t n);
int					ft_memcmp(const void *s1, const void *s2, size_t n);
size_t				ft_strlen(const char *s);
char				*ft_strcpy(char *dest, const char *src);
char				*ft_strncpy(char *dest, const char *src, size_t n);
char				*ft_strdup(char *src);
char				*ft_strcat(char *restrict dst, const char *restrict src);
char				*ft_strncat(char *restrict dst, const char *restrict src, size_t n);
size_t				ft_strlcat(char *restrict dst, const char *restrict src, size_t size); // TODO
char				*ft_strchr(const char *s, int c);
char				*ft_strrchr(const char *s, int c);
char				*ft_strstr(const char *haystack, const char *needle); // TODO
char				*ft_strnstr(const char *haystack, const char *needle, size_t len); // TODO
int					ft_strcmp(const char *s1, const char *s2); // TODO
int					ft_strncmp(const char *s1, const char *s2, size_t n); // TODO
int					ft_atoi(const char *str); // TODO
int					ft_isalpha(int c); // TODO
int					ft_isdigit(int c); // TODO
int					ft_isalnum(int c); // TODO
int					ft_isascii(int c); // TODO
int					ft_isprint(int c); // TODO
int					ft_toupper(int c); // TODO
int					ft_tolower(int c); // TODO
void				*ft_memalloc(size_t size); // TODO
void				ft_memdel(void **ap); // TODO
char				*ft_strnew(size_t size); // TODO
void				ft_strdel(char **as); // TODO
void				ft_strclr(char *s); // TODO
void				ft_striter(char *s, void (*f)(char *)); // TODO
void				ft_striteri(char *s, void (*f)(unsigned int, char *)); // TODO
char				*ft_strmap(char const *s, char (*f)(char)); // TODO
char				*ft_strmapi(char const *s, char (*f)(unsigned int, char)); // TODO
int					ft_strequ(char const *s1, char const *s2); // TODO
int					ft_strnequ(char const *s1, char const *s2, size_t n); // TODO
char				*ft_strsub(char const *s, unsigned int start, size_t len); // TODO
char				*ft_strjoin(char const *s1, char const *s2); // TODO
char				*ft_strtrim(char const *s); // TODO
char				**ft_strsplit(char const *s1, char c); // TODO
char				*ft_itoa(int n); // TODO
void				ft_putchar(char c); // TODO
void				ft_putstr(char const *str); // TODO
void				ft_putendl(char const *s); // TODO
void				ft_putnbr(int n); // TODO
void				ft_putchar_fd(char c, int fd); // TODO
void				ft_putstr_fd(char const *s, int fd); // TODO
void				ft_putendl_fd(char const *s, int fd); // TODO
void				ft_putnbr_fd(int n, int fd); // TODO
t_list				*ft_lstnew(void const *content, size_t content_size); // TODO
void				ft_lstdelone(t_list **alst, void (*del)(void *, size_t)); // TODO
void				ft_lstdel(t_list **alst, void (*del)(void *, size_t)); // TODO
void				ft_lstadd(t_list **alst, t_list *new); // TODO
void				ft_lstiter(t_list *lst, void (*f)(t_list *elem)); // TODO
t_list				*ft_lstmap(t_list *lst, t_list *(*f)(t_list *elem)); // TODO

#endif