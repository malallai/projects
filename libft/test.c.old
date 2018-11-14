/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   test.c                                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/13 15:43:52 by malallai          #+#    #+#             */
/*   Updated: 2018/11/13 15:57:44 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

size_t	ft_strlcat(char *dst, const char *src, size_t size)
{
	char *d;
	const char *s;
	size_t dlen;
	size_t n;

	d = dst;
	s = src;
	n = size;
	while (n-- != 0 && *d != 0)
		d++;
	printf("%s\n", d);
	dlen = d - dst;
	printf("%d\n", dlen);
	n = size - dlen;
	if (!n)
		return (dlen + ft_strlen(s));
	while (*s != '\0')
	{
		if (n != 1)
		{
			*d++ = *s;
			n--;
		}
		s++;
	}
	printf("%s\n", d);
	*d = 0;
	printf("%d %d %d\n", s, src, (s - src));
	return (dlen + (s - src));
}

int		main(void)
{
	char t[1024] = "LoremIpsum";
	printf("%zu\n", ft_strlcat(t, "Salut les amis", 12));
	return (0);
}

