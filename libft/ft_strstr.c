/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strstr.c                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/10 15:40:03 by malallai          #+#    #+#             */
/*   Updated: 2018/11/12 13:12:09 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

char	*ft_strstr(const char *h, const char *n)
{
	char	*haystack;
	char	*needle;
	int		i;

	if (!h)
		return (NULL);
	if (!n)
		return ((char *)h);
	haystack = (char *)h;
	needle = (char *)n;
	while (*haystack++)
	{
		if (*haystack == needle[0])
		{
			i = 1;
			while (needle[i] && *(haystack + i) == needle[i])
				i++;
			if (!needle[i])
				return (haystack);
		}
	}
	return (NULL);
}
